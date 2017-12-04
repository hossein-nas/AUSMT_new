<?php

namespace App\Http\Controllers\Files;

use Illuminate\Http\Request;

use App\Http\Requests;
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
    public function record_thumbnail(Request $requests)
    {
        if ($requests->hasFile('record_thumbnail')) {
            $data = [];
            $data ['filePath'] = $requests->file('record_thumbnail')->getRealPath();
            $data ['file'] = file_get_contents( $data['filePath'] );
            $data ['ext'] = $requests->file('record_thumbnail')->extension();
            $data ['orig_name'] = $requests->get('orig_name');
            $data ['name'] = sha1( $data['file'] );
            $data ['title'] = '';
            $data ['base_dir_path'] = 'files/images/record_thumbnails';
            $data ['file_category_id'] = 3;
            $data ['responsive_image'] = true;
            if ( $p = $this->responsiveImage($data) ){
                return Response::json([
                    'status' => 1,
                    'text' => 'تصویر با موفقیت بارگذاری شد.',
                    'url' =>  url('') . '/' . $p['multivalue'][1]['file_fullpath']
                ]);
            }
            else
                return Response::json([
                    'status' => 0,
                    'text' => 'متأسفانه،‌ تصویر با موفقیت بارگذاری نشد!',
                    'detail' => $p->toArry()
                ]);
        }
    }

    private function fileStore($file, $destFullPath)
    {
        try {
            $path = Storage::disk('public')->put($destFullPath, $file);
            $size = Storage::disk('public')->size($destFullPath);

        } catch (FileNotFoundException $e) {
            return false;
        }
        return  [
                'fullPath' => $destFullPath,
                'filesize' => $size,
            ];;
    }

    private function responsiveImage($data)
    {
        $frames = [
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
            ]
        ];

        /* ...Storing file data to database... */
        if ( !$rel_id = $this->saveFileToDB($data) )
        {
            return $this->getFileByFileUniqueName($data['name']);
        }

        foreach ($frames as $key => $frame) {
            $path = $data['base_dir_path'] . '/' . $key . '/';
            $name = $data['name'] . '_' . $frame['width'];
            $destFullPath = $path . $name . '.' . $data['ext'];
            $image = Image::make($data['filePath'])->resize($frame['width'], $frame['height'])->encode();
            $r = $this->fileStore($image->encoded, $destFullPath);
            if ($r) {
                $detail = [
                    'rel_id' => $rel_id,
                    'filesize' => $r['filesize'],
                    'file_fullpath' => $r['fullPath'],
                    'width' => $frame['width'],
                    'height' => $frame['height'],
                    'ratio' => $frame['width'] / $frame['height']
                ];
                $data['multivalue'] = $detail;
                $this->saveMultiVal($data);
                $tmp[] = $detail;
            }
        }
        $data['multivalue'] = $tmp;
        return $data;
    }

    private function generateFilePathFromExtension($file, $ext)
    {

    }

    public function browseFiles()
    {
        $files = File::files('media/fastmenu');
        return ($files);
    }

    private function getExtIDByName($ext)
    {
        return File_Extension::where('extension',$ext)->first()->id;
    }

    private function getCatIDByFolderPath($dirName){
        return File_Category::where('dir_name',$dirName)->first()->id;

    }

    private function saveFileToDB($data){
        if ($this->checkFileExistsOnDB($data['name']))
            return false;

        $f = new FFile;
        $f->orig_name = $data['orig_name'];
        $f->name = $data['name'];
        $f->extension_id = $this->getExtIDByName( $data['ext'] );
        $f->file_category_id = $data['file_category_id'];
        $f->title = $data['title'];
        $f->responsive_image = $data['responsive_image'];
        try{
            $f->save();
            return $f->id;
        }catch (Exception $e){
            return false;
        }
    }

    private function saveMultiVal($data){
        $m = new MVFile;
        $m->related_file_id = $data['multivalue']['rel_id'];
        $m->file_fullpath = $data['multivalue']['file_fullpath'];
        $m->ratio = $data['multivalue']['ratio'];
        $m->filesize = $data['multivalue']['filesize'];
        $m->height = $data['multivalue']['height'];
        $m->width = $data['multivalue']['width'];
        $m->save();
    }

    public function test(){
        dd($this->getFileByFileUniqueName('test22www22'));
        $data = [
            'filePath' => 'media/photos/medium/3.png',
            'name' => 'test22www22',
            'orig_name' => 'test1.png',
            'base_dir_path' => 'files/images/record_thumbnails',
            'ext' => 'png',
            'title' => 'png',
            'responsive_image' => true,
            'file_category_id' => 3,
        ];
        $data['file'] = file_get_contents( $data['filePath'] );
        $this->responsiveImage($data);
    }

    private function checkFileExists($filePath){
        return Storage::disk('public')->exists($filePath);
    }

    private function checkFileExistsOnDB($fileUniqueName){
        if (FFile::where('name',$fileUniqueName)->first())
            return true;
        return false;
    }

    private function getFileByFileUniqueName($UName){
        $file = FFile::where('name',$UName)->get()->first();
        if($file){
            $file->multivalue = MVFile::where('related_file_id',$file->id)->get()->toArray();
            return $file->toArray();
        }
        return false;
    }
}
