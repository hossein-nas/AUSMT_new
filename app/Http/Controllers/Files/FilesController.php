<?php

namespace App\Http\Controllers\Files;

use App\Http\Requests\FileUploadRequest;
use Approached\LaravelImageOptimizer\ImageOptimizer;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Files\File_Extension;
use App\Models\Files\File_Category;
use App\Models\Files\File_MultiValue as MVFile;
use App\Models\Files\File as FFile;
use League\Flysystem\FileNotFoundException;
use Mockery\Exception;


class FilesController extends Controller
{

    public function uploadNewFile(FileUploadRequest $requests)
    {
        $filename_in_request = 'selected_file';
        if ( !$this->checkForFileExistInRequest( $filename_in_request ) )
            return $this->errorFileNotUpload();

        $this->getFileFromRequest( $filename_in_request, $requests);
        $ext = $requests->file( $filename_in_request )->extension();
        $ret = $this->save($requests, $ext);
        if ($ret['status'] == 'success')
            return back()->with($ret);
        return back()->with($ret);
    }

    public function showFileManagementPage()
    {
        $categories = (new FilesCategoryController)->getAllCategories();
        return view('cpanel.pages.files.files_management', compact(['categories']));
    }

    public function addNewFilePage()
    {
        $categories = (new FilesCategoryController)->getAllCategories();
        return view('cpanel.pages.files.add_new_file', compact(['categories']));
    }

    public function record_thumbnail(FileUploadRequest $requests)
    {
        $filename_in_request = 'record_thumbnail';

        if ( !$this->checkForFileExistInRequest( $filename_in_request ) )
            return $this->errorFileNotUpload();

        if ( !$this->checkForAjaxRequest() )
            return $this->errorNotAjaxRequest();


        $this->getFileFromRequest( $filename_in_request, $requests);
        $ext = $requests->file( $filename_in_request )->extension();
        $ret = $this->save($requests, $ext);

        return Response::json($ret);
    }

    private function getFileFromRequest($file_name, &$req){
        $file = file_get_contents( request()->file($file_name)->getRealPath() );
        $req->request->add(['file' => $file] );
        return true;
    }
    private function checkForFileExistInRequest($file_name){
        if ( !request()->hasFile($file_name) )
            return false;
        return true;
    }

    private function checkForAjaxRequest(){
        if ( !request()->ajax() )
            return false;
        return true;
    }

    private function errorFileNotUpload(){
        return Response::json([
            'code' => 3,
            'status' => 'failure',
            'response' => 'file not uploaded',
            'text' => 'فایل به درستی بارگذاری نشده است',
        ],400);
    }

    private function errorNotAjaxRequest(){
        return Response::json([
            'code' => 4,
            'status' => 'failure',
            'response' => 'request is not ajax',
            'text' => 'درخواست ارسالی قابل پردازش نیست',
        ],400);
    }

    private function errorUnexpectedInSave(){
        return [
            'code' => 0,
            'status' => 'failure',
            'response' => 'unxpected error occur',
            'text' => 'خطای نا مشخصی رخ داد'
        ];
    }

    public function addNewAttachament(FileUploadRequest $requests)
    {
        $filename_in_request = 'attachment_file';

        if ( !$this->checkForFileExistInRequest( $filename_in_request ) )
            return $this->errorFileNotUpload();

        if ( !$this->checkForAjaxRequest() )
            return $this->errorNotAjaxRequest();

        $this->getFileFromRequest( $filename_in_request, $requests);
        $ext = $requests->file( $filename_in_request )->extension();
        $ret = $this->save($requests, $ext);

        if ($ret['status'] == 'success' )
        {
            $res = [
                'id' => $ret['id'],
                'name' => $ret['name'],
                'filesize' => HumanReadableFilesize( (int) $ret['multivalue']['filesize'],2),
                'extension' => $ret['ext'],
                'orig_name' => $ret['orig_name'] . '.' . $ret['ext'],
                'title' => $ret['title'],
                'icon_path' => $this->getFileExtensionIconByExtId($ret['extension_id'])
            ];
            return Response::json($res);
        }
        return Response::json($ret,400) ;
    }

    public function saveNewFile(Array $data)
    {
        /*
         * $data = [
         *      'filepath' =>
         *      'file_orig_name' =>
         *      'file_title' =>
         *      'file_description' =>
         *      'cat_id' =>
         *      'ext' =>
         *      'responsive_image' =>
         * */
        if ( !is_array($data) )
            return null;

        $d = collect();
        $d->file =  file_get_contents($data['filepath']) ;
        $d->file_orig_name = $data['file_orig_name'] ;
        $d->file_title = $data['file_title'] ;
        $d->file_description = $data['file_description'] ;
        $d->cat_id = $data['cat_id'] ;
        $d->ext = $data['ext'] ;
        $d->responsive_image = $data['responsive_image'] ;
        $ret = $this->save($d, $d->ext);
        return collect($ret);

    }

    private function physicalSave($data, $fullpath)
    {
        $file = $data['file'];
        try {
            Storage::disk('public')->put($fullpath, $file);
            $filesize = Storage::disk('public')->size($fullpath);
            if ( $this->isImage($data))
                (new ImageOptimizer())->optimizeImage(public_path().$fullpath);
        } catch (Exception $e) {
            return false;
        }
        $data['multivalue']= [
            'filesize' => $filesize,
            'file_fullpath' => $fullpath,
            'related_file_id' => $data['id'],
            'ratio' => '',
            'height' => 0,
            'width' => 0
        ];
        return $data;
    }

    private function saveResponsiveImage($data)
    {
        $frames = $this->getResponsiveImageFrame();

        foreach( $frames  as $fname => $frame ){

            $basepath = $this->generateBasepathByCatId( $data['file_category_id'], [$fname] );
            $fullpath = $this->generateFileFullPath($basepath,$data['name'].'_'.$frame['width'], $data['ext'] );


            // Checking for file exists in disk
            if ( !$this->checkFileExists($fullpath) )
                $data = $this->physicalSave($data, $fullpath);

            // Resizing Image
            Image::make('.'. $fullpath)->resize($frame['width'], $frame['height'])->save();

            // Adding file to multivalue table
            $this->saveMultiVal($data);
        }

        return $data;
    }

    private function getExtIDByName($ext)
    {
        if ($ret = File_Extension::where('extension', $ext)->first() )
            return $ret->id;
        return false;
    }

    private function getCatIDByFolderPath($dirName)
    {
        return File_Category::where('dir_name', $dirName)->first()->id;

    }

    private function getResponsiveImageFrame()
    {
        return [
            'large' => [
                'width' => 1200,
                'height' => 750
            ],
            'medium' => [
                'width' => 768,
                'height' => 480
            ],
            'small' => [
                'width' => 480,
                'height' => 300
            ],
            'extra_small' => [
                'width' => 192,
                'height' => 120
            ]
        ];
    }

    private function saveFileToDB($data)
    {
        $f = new FFile;
        $f->orig_name = $data['orig_name'];
        $f->name = $data['name'];
        $f->extension_id = $this->getExtIDByName($data['ext']);
        $f->file_category_id = $data['file_category_id'];
        $f->title = $data['title'];
        $f->responsive_image = isset($data['responsive_image']) ? $data['responsive_image'] : 0;
        $f->description = isset($data['description']) ? $data['description'] : '';
        try {
            $f->save();
            $data['id'] = $f->id;
            return $data;
        } catch (Exception $e) {
            return false;
        }
    }

    private function saveMultiVal($data)
    {
        $m = new MVFile;
        $m->related_file_id = $data['multivalue']['related_file_id'];
        $m->file_fullpath = $data['multivalue']['file_fullpath'];
        $m->ratio = isset($data['multivalue']['ratio']) ? $data['multivalue']['ratio'] : '';
        $m->filesize = $data['multivalue']['filesize'];
        $m->height = isset($data['multivalue']['height']) ? $data['multivalue']['height'] : '';
        $m->width = isset($data['multivalue']['width']) ? $data['multivalue']['width'] : '';
        $m->save();
    }

    private function checkFileExists($filePath)
    {
        return Storage::disk('public')->exists($filePath);
    }

    private function checkFileExistsOnDB($fileUniqueName)
    {
        if (FFile::where('name', $fileUniqueName)->first())
            return true;
        return false;
    }

    public function getFileByFileUniqueName($data)
    {
        $file = FFile::where('name', $data['name'])->get()->first();
        if ($file) {
            $mv = $file->specs->first();
            $data['id'] = $file->id;
            $data['status'] = 'success';
            $data['multivalue']['related_file_id'] = $file->id;
            $data['multivalue']['file_fullpath'] = $mv->file_fullpath;
            $data['multivalue']['ratio'] = $mv->ratio;
            $data['multivalue']['filesize'] = $mv->filesize;
            $data['multivalue']['height'] = $mv->height;
            $data['multivalue']['width'] = $mv->width;
            unset($data['file']);
            return $data;
        }
        return $this->errorUnexpectedInSave();
    }

    private function getFileExtByMimytype($mime)
    {
        $it = File_Extension::where('mimetype', $mime)->first();
        if ($it)
            return $it->extension;
        return false;
    }

    private function getFileBasepathByCatId($cat_id)
    {
        $ret = File_Category::where('id', $cat_id)->first();
        if ($ret)
            return $ret->base_dir_path;
    }

    private function getFileExtensionIconByExtId($ext_id){
        return File_Extension::findOrFail($ext_id)->icon->specs->first()->file_fullpath;
    }

    private function generateBasepathByCatId($cat_id, $new_dir=null)
    {
        $basepath = $this->getFileBasepathByCatId($cat_id);
        $append = '';
        if($new_dir and is_array($new_dir) ){
            foreach ($new_dir as $dir){
                $append .= '/' . $dir;
            }
        }
        return $basepath . $append;
    }

    private function isAcceptedExt($ext){
        if ( $ret = File_Extension::where('extension', $ext)->first() )
            return true;
        return false;
    }
    private function checkAcceptedFileType($mime){
        $ext = $this->getFileExtByMimytype($mime);
        if (!$ext)
            return false;
        return true;
    }

    private function generateFileFullPath($basepath, $name, $ext){
        return $basepath . '/' . $name . '.' . $ext;
    }

    private function isImage($data)
    {
        $ext = $data['ext'];
        switch ($ext) {
            case 'jpeg':
            case 'jpg':
            case 'png':
            case 'gif':
            case 'svg':
                return true;
                break;
        }
        return false;
    }

    private function save($req, $ext)
    {
        /*
         * Checking Accepted Extension
         * */
        if ( !$this->isAcceptedExt($ext) )
            return [
                'code' => 0,
                'status' => 'failure',
                'response' => 'extension doesn\'n exists ',
                'text' => 'فایل انتخابی قابل قبول نیست',
            ];

        $data = [
            'file' => $req->file,
            'name' => sha1($req->file),
            'orig_name' => $req->file_orig_name,
            'file_category_id' => $req->cat_id,
            'description' => $req->file_description,
            'title' => $req->file_title,
            'ext' => $ext,
            'extension_id' => $this->getExtIDByName( $ext ),
            'responsive_image' => (int) $req->responsive_image,
            'multivalue' => []
        ];

        /*
         * Check for file exist in DB or Not
         * */
        if( $this->checkFileExistsOnDB( $data['name'] ) )
        {
            return $this->getFileByFileUniqueName($data);
        }

        $data = $this->saveFileToDB($data);

        /*
         * Check for Responsive Image
         * */
        if ( $data['responsive_image'] === 1)
        {
            $ret = $this->saveResponsiveImage($data);
            $ret['status'] = 'success';
            unset($ret['file']);
            return $ret;
        }

        /*
         * Storing file in disk
         * */
        $basepath = $this->generateBasepathByCatId( $data['file_category_id'] );
        $fullpath = $this->generateFileFullPath($basepath, $data['name'], $data['ext']);
        // Check for file exist on disk or Not
        if( !$this->checkFileExists($fullpath) )
            $data = $this->physicalSave($data, $fullpath);

        /*
         * Adding file to MultiValue table
         * */
        $this->saveMultiVal($data);
        $data['status'] = 'success';
        unset( $data['file'] );
        return $data;
    }
}
