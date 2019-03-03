<?php

namespace App\Http\Controllers\Files;

use App\Http\Requests\FileUploadRequest;
use Approached\LaravelImageOptimizer\ImageOptimizer;

use App\Http\Requests;
use Illuminate\Http\Request;
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
use Mockery\Exception;


/**
 * Class FilesController
 * @package App\Http\Controllers\Files
 */
class FilesController extends Controller
{
    protected $attr = null;
    protected $errors = null;
    protected $req = null;

    public function addNewFilePage()
    {
        $categories = (new FilesCategoryController())->getAllCategories();
        return view('cpanel.pages.files.add_new_file', compact(['categories']));
    }

    /**
     * @param FileUploadRequest $req
     * @return string
     * @throws \Exception
     */
    public function uploadNewFile(FileUploadRequest $req)
    {
        $this->req = &$req;
        // validate Reqest Params
        $this->validateReqParams();

        // check for existence
        if ($this->checkFileExist() == 4) { // 4 means file exist in db and disk and no need for more try
            echo "File Exist";
            dd($this->attr);
            return $this->resp('success', 400);
        }

        // check for validity for accepted file sent to server
        $this->checkValidFileExtention();

        // move file to temporary path
        $this->moveFileToTemporaryPath();


        if ($this->isImage()) {

            if ($this->shouldOptimize()) {
                $this->imageOptimize($req);
            }

            if ($this->isResponsiveImage()) {
                $this->createResponsiveImage();
            }
        }

        $this->PersisteFile();


    }

    /**
     * @param array $arr
     * $arr structure
     * $arr = [
     *      'filename' = '',
     *      'full_path' = '',
     *      'extension' = '',
     *      'orig_name' = '',
     *      'cat_id' = '',
     *      'title' = '',
     *      'description = '',
     *      'is_responseive' = false,
     *      'is_image' =
     * ]
     * @return null
     */
    public function localFileToDB(array $arr)
    {
        $attr = [
            'title' => strtoupper($arr['ext']),
            'description' => '',
            'extension_id' => $this->getExtIDbyExt($arr['ext']),
            'category_id' => $this->getCatIDByDirPath($arr['basedir']),
        ];
        $attr ['files'] [] = [
            'filename' => $arr['orig_name'],
            'fullpath' => $arr['sourcedir'] . '/' . $arr['orig_name'],
            'basedir' => $arr['sourcedir'] . '/'
        ];
        $attr = array_merge($arr, $attr);
        $this->addTo('attr', $attr);
        if ($this->checkFileExistOnDB()) {
            $this->loadFileInfoFromDB();
        } else {
            $this->addFileToDB();
            $this->addFileToDisk();
            $this->addMultivalueInfoToDB();
        }
        return $this->attr;
    }

    /**
     * @param int $error_code
     * @param null $error_desc
     */
    public function resp($error_code = 1000, $error_desc = null)
    {
    }

    /**
     * This is Function works for validating FileUploadRequest $requests that comes in to 'saveNewFile'
     * Controllerf
     * @param $req
     *
     * @return bool
     */
    public function validateReqParams()
    {
        $attr = [];
        $errors = [];
        $req = $this->req;

        if (!(isset($req->file) and $req->hasFile('file') and $req->file->isValid()))
            $error [] = 501;


        if ($req->has('cat_id') || $req->has('file_fullpath')) {
            $attr['category_id'] = $this->getValidCatId($req);
            $attr['basedir'] = $this->getDirByCatId($attr['category_id']);
        } else
            $errors[] = 509;

        // check for flags
        $attr ['is_image'] = (isset($req->is_image) and $req->is_image == 1) ? true : false;
        $attr ['is_responsive'] = (isset($req->is_responsive) and $req->is_responsive == 1) ? true : false;
        $attr ['should_optimize'] = (isset($req->should_optimize) and $req->should_optimize == 1) ? true : false;

        // adding method to attr's
        $attr ['hashName'] = $req->file->hashName();
        $attr ['name'] = $this->generateHashName();
        $attr ['ext'] = $req->file->extension();

        $this->addto('attr', $attr);
        $this->addto('errors', $errors);
//        dd("Attr:", $this->attr, "Errors:", $this->errors);

        return true;
    }

    /**
     * @return bool
     */
    private function checkValidFileExtention()
    {
        $ret = collect([]);
        $res = File_Extension::all()->each(function ($item, $key) use ($ret) {
            $ret->push($item->extension);
        });
        $ext = $this->attr['ext'];

        if ($ret->contains($ext))
            return true;
        return false;
    }

    /**
     * @return bool
     */
    private function checkFileExist()
    {
        $tmp = 1;
        $this->checkFileExistOnDB() ? $tmp += 1 : false;
        $this->checkFileExistOnDisk() ? $tmp += 2 : false;

        // 1 means not exist
        // 2 means just exist in DB
        // 3 means just exist in Disk
        // 4 means exist in both (DB, Disk)
        if ($tmp == 2 || $tmp == 3) {
            FFile::where('name', $this->generateHashName())->delete();
            return $tmp;
        } else if ($tmp == 4) {
            $this->loadFileInfoFromDB();
            return $tmp;
        } else
            return false;
    }

    /**
     * @param $req
     * @return bool or File Object
     */
    public function checkFileExistOnDB()
    {
        $errors = [];

        $name = $this->attr['name'];
        $file_ = FFile::where('name', $name)->first();
        if ($file_) {
            return true;
            $attr = ['file_exist_on_db' => true];

            $this->addto('attr', ['file_exist_on_db' => true]);
        }

        $this->addto('attr', ['file_exist_on_db' => false]);
        return false;
    }

    private function checkFileExistOnDisk()
    {
        $files = [];
        $ret = [];

        $cat_id = $this->attr['category_id'];
        $filename = $this->generateHashName();
        $ext = $this->attr['ext'];
        $base_dir = $this->getDirByCatId($cat_id);

        if ($this->checkFileExistOnDB()) {
            $file = $this->loadFileInfoFromDB();
        }

        if ($this->isResponsiveImage() && $this->isImage()) {
            $frames = $this->getResponsiveImageFrame();
            foreach ($frames as $fname => $frame) {
                $files [] = public_path() . $base_dir . '/' . $fname . '/' . $filename . '_' . $frame['width'] . '.' . $ext;
            }
        } else {
            $full_path = public_path() . $base_dir . '/' . $filename . '.' . $ext;
            $files[] = $full_path;
        }

        foreach ($files as $f) {
            $ret [] = @file_exists($f);
        }

        // check for failed exited files
        $ret = array_unique($ret);
        $existed = (count($ret) == 1 && $ret[0] == true) ? true : false;

        if ($existed) {
            $this->addTo('attr', ['file_exist_on_disk' => true]);
            return true;
        }
        $this->addTo('attr', ['file_exist_on_disk' => false]);
        return false;
    }


    /**
     * @return bool
     */
    private function shouldOptimize()
    {
        $ext = $this->attr['ext'];
        if ($this->attr['should_optimize'] == true && ($this->getOptimizableExt()->contains($ext)))
            return true;
        return false;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function getOptimizableExt()
    {
        return collect([
            'png',
            'jpeg',
            'jpe',
            'gif'
        ]);
    }

    /**
     * @return bool
     */
    private function isResponsiveImage()
    {
        if ($this->attr['is_responsive'] == true)
            return true;
        return false;
    }

    private function getExistedFileFromDB($req)
    {
        $name = $this->generateHashName($req);
        $file = FFile::where('name', $name)->first();
        return $file;
    }


    /**
     * @param $req
     * @return bool | integer
     */
    public function getValidCatId(&$req)
    {
        if (!$req->has('cat_id') && !$req->has('file_fullpath')) {
            $errors = [509];
            $this->addToReq(compact('errors'));
            return false;
        }

        if ($req->has('file_fullpath')
            and (is_valid_path($req->file_fullpath))) {
            $cat_id = $this->getCatIDByDirPath($req->file_fullpath);
        } else
            $cat_id = $req->cat_id;

        if ($this->checkForValidCatID($cat_id)) {
            return $cat_id;
        }
        return false;

    }

    private function checkValidAddress(&$req)
    {
        $ret = $this->getValidCatId($req);
        if ($ret)
            return true;
        return false;
    }

    /**
     * @param $id
     * @return bool
     */
    private function checkForValidCatID($id)
    {
        $ret = File_Category::where('id', $id)->first();
        if ($ret)
            return true;
        return false;
    }

    /**
     * @return bool
     */
    private function isImage()
    {
        $ext = $this->attr['ext'];
        $client_isImage = $this->attr['is_image'];
        $server_isImage = $this->isAcceptedImage($ext);
        if ($client_isImage && $server_isImage)
            return true;
        return false;
    }

    /**
     * @param $ext
     * @return bool
     */
    private function isAcceptedImage($ext)
    {
        $ext_array = [
            'png',
            'jpeg',
            'jpg',
            'gif',
            'svg',
        ];
        if (in_array($ext, $ext_array))
            return true;
        return false;
    }

    public function generateProperty()
    {
        $attr = [];
        $errors = [];
        $req = &$this->req;

        if (isset($req->file_title) and $req->file_title != '')
            $attr['title'] = $req->file_title;
        else
            $attr['title'] = 'بدون عنوان';

        if (isset($req->file_description) and $req->file_description != '')
            $attr['description'] = $req->file_description;
        else
            $attr['description'] = 'بدون توصیحات...';

        if (isset($req->file_orig_name) and $req->file_orig_name != '')
            $attr['orig_name'] = $req->file_orig_name;
        else
            $errors[] = 510;

        $attr ['is_ajax'] = $req->ajax();
        $attr ['extension_id'] = $this->getExtIDbyExt($this->attr['ext']);
        $attr ['method'] = $req->method();
        $attr['mimetype'] = $req->file->getClientMimeType();
        $attr['remote_addr'] = $req->server()['REMOTE_ADDR'];
        $attr['request_time'] = $req->server()['REQUEST_TIME'];


        if ($this->isImage() == false) {
            $attr['files'] [] = $this->attr['tmp_path'];
        }

        $this->addTo('attr', $attr);
        $this->addTo('errors', $errors);

        return true;

    }

    /**
     * @throws \Exception
     */
    public function imageOptimize()
    {
        if (isset($this->attr['should_optimize']) and $this->attr['should_optimize'] == true) {
            try {
                $file = $this->attr['tmp_path']['fullpath'];
                (new ImageOptimizer())->optimizeImage($file);
                $attr = ['successful_optimize' => true];
                $this->addTo('attr', $attr);
            } catch (Exception $e) {
                echo "Error in Optimize";
                $attr = ['successful_optimize' => false];
                $this->addTo('attr', $attr);
            }
        }
    }

    /**
     * @param $req
     * @return bool
     */
    public function createResponsiveImage()
    {
        $files = [];
        $frames = $this->getResponsiveImageFrame();
        $filename = $this->generateHashName();
        $basedir = $this->attr['tmp_path']['basedir'];
        $fullpath = $this->attr['tmp_path']['fullpath'];
        $ext = $this->attr['ext'];

        foreach ($frames as $fname => $frame) {
            $_basedir = $basedir . $fname . '/';
            $_filename = $filename . '_' . $frame['width'] . '.' . $ext;
            if (!is_dir($_basedir))
                mkdir($_basedir, 0777, true);

            $_fullpath = $_basedir . $_filename;
            $img = Image::make($fullpath)->resize($frame['width'], $frame['height']);
            $img->save($_fullpath, 100);
            $files [] = ['filename' => $_filename, 'fullpath' => $_fullpath, 'basedir' => $_basedir, 'subfolder' => $fname];
        }
        $attr ['files'] = $files;
        $this->addTo('attr', $attr);

        return true;

    }

    /**
     * in this Function MultiValue Table Property sets in to $request
     * @return bool
     */
    public function addMultivalueInfoToDB()
    {

        $attr = $this->attr;
        $errors = [];
        $mv = [];

        if (isset($attr['files'])) {
            $files = $attr['files'];
            foreach ($files as $f) {
                $file_path = $f['fullpath'];
                $filesize = filesize(public_path() . $file_path);
                $height = ($this->isImage()) ? getimagesize($file_path)[1] : null;
                $width = ($this->isImage()) ? getimagesize($file_path)[0] : null;
                $ratio = ($this->isImage()) ? $height / $width : null;
                $mv [] = [
                    'related_file_id' => $attr['id'],
                    'file_fullpath' => $file_path,
                    'filesize' => $filesize,
                    'height' => $height,
                    'width' => $width,
                    'ratio' => $ratio
                ];
            }
            $ret = MVFile::insert($mv);
            $attr['mvfiles_specs'] = $mv;
            $attr['multivalue_files_added_to_db'] = true;
            $this->addTo('attr', $attr);
            return true;
        }
        return false;

    }

    /**
     * @param $ext
     * @return bool
     */
    public function getExtIDbyExt($ext)
    {
        if ($ret = File_Extension::where('extension', $ext)->first())
            return $ret->id;
        return false;
    }

    public function moveFileToTemporaryPath()
    {
        $realPath = $this->req->file->getRealPath();

        $basedir = storage_path('app/public/');
        $filename = $this->attr['hashName'];

        if (file_exists($realPath))
            copy($realPath, $basedir . $filename);
        else
            return false;
        $ret = [
            'fullpath' => $basedir . $filename,
            'basedir' => $basedir,
            'filename' => $filename
        ];
        $attr ['tmp_path'] = $ret;

        $this->addto('attr', $attr);

        return $ret;

        /*
         * Return Structure
         * [
         *      'fullpath' => '',
         *      'filename' => '',
         *      'basedir' => ''
         * ]
         * */
    }

    private function removeFilesFromTemporaryPath()
    {
        $tmpfile = $this->attr['tmp_path']['fullpath'];
        if (@file_exists($tmpfile))
            unlink($tmpfile);
        $attr ['tmp_path'] = false;
        $this->addTo('attr', $attr);
    }

    /**
     * @param $cat_id
     * @return bool
     */
    public function getDirByCatId($cat_id)
    {
        $ret = File_Category::where('id', $cat_id)->first();
        if ($ret)
            return $ret->base_dir_path;
        return false;
    }

    public function getCatIDByDirPath($dir_path)
    {
        $ret = File_Category::where('base_dir_path', $dir_path)->first();
        if ($ret)
            return $ret->id;
        return false;
    }

    /**
     * @return string
     */
    public function generateHashName()
    {
        $name = $this->req->file->hashName();
        $name = substr($name, 0, strrpos($name, '.'));
        return $name;
    }

    /**
     * @param $base_path
     * @param $filename
     * @param $ext
     * @return array
     */
    private function createResponsiveImagePath($base_path, $filename, $ext)
    {
        $frames = $this->getResponsiveImageFrame();
        $paths = [];
        foreach ($frames as $fname => $frame) {
            $arr = [
                $fname => [
                    'base_dir' => $base_path . '/' . $fname,
                    'fullpath' => $base_path . '/' . $fname . '/' . $filename . '_' . $frame['width'] . '.' . $ext,
                    'width' => $frame['width'],
                    'height' => $frame['height']
                ]
            ];
            $paths = array_merge($paths, $arr);
        }
        return $paths;
    }

    /**
     * @return array
     */
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

    /**
     */
    private function addFileToDB()
    {
        $file = new FFile;
        $file->name = $this->attr['name'];
        $file->orig_name = $this->attr['orig_name'];
        $file->responsive_image = $this->attr['is_responsive'];
        $file->file_category_id = $this->attr['category_id'];
        $file->extension_id = $this->attr['extension_id'];
        $file->title = $this->attr['title'];
        $file->description = $this->attr['description'];
        $file->save();

        $attr['id'] = $file->id;
        $attr['file_addded_to_db'] = true;
        $this->addTo('attr', $attr);
    }

    private function addFileToDisk()
    {
        $f = [];
        $subfolder = '';
        $req = $this->req;

        if (isset($this->attr['files'])) {
            $files = $this->attr['files'];
            foreach ($files as $file) {
                $old_file = $file['fullpath'];

                if (isset($file['subfolder']))
                    $subfolder = '/' . $file['subfolder'];

                $basedir = public_path() . $this->attr['basedir'] . $subfolder;
                $new_file = $basedir . '/' . $this->attr['hashName'];
                if (!is_dir($basedir))
                    mkdir($basedir, 0777, true);
                copy($old_file, $new_file);
                $new_file = str_replace(public_path(), '', $new_file);
                $basedir = str_replace(public_path(), '', $basedir);
                $f [] = [
                    'filename' => $this->attr['hashName'],
                    'fullpath' => $new_file,
                    'basedir' => $basedir
                ];
            }
            $attr ['files'] = $f;
            $attr['file_addded_to_disk'] = true;
            $this->addTo('attr', $attr);
        }
    }

    private function PersisteFile()
    {
        $this->generateProperty();
        $this->addFileToDB();
        $this->addFileToDisk();
        $this->addMultivalueInfoToDB();
        $this->removeFilesFromTemporaryPath();
        dd($this->attr);
    }

    private function addToReq(array $arr)
    {
        foreach ($arr as $k => $val) {
            if (isset($this->req->$k) && is_array($this->req->$k)) {
                $tmp = array_merge($this->req->$k, $val);
                $tmp = [$k => $tmp];
                $this->req->request->add($tmp);
            } else {
                $tmp = [$k => $val];
                $this->req->request->add($tmp);
            }
        }
    }

    private function addTo(string $str, array $arr)
    {
        if ($str == 'attr' || $str == 'errors') {
            $keys = array_keys($arr);
            foreach ($keys as $key) {
                $this->$str[$key] = $arr[$key];
            }
        }
    }

    private function loadFileInfoFromDB()
    {
        $name = $this->attr['name'];
        $file = FFile::where('name', $name)->first();
        $attr = [
            'id' => $file->id,
            'name' => $name,
            'orig_name' => $file->orig_name,
            'hashName' => $this->attr['hashName'],
            'category_id' => $file->file_category_id,
            'extension' => $file->extension->extension,
            'mimetype' => $file->extension->mimetype,
            'filetype' => $file->extension->filetype->name_fa,
            'extension_id' => $file->extension_id,
            'basedir' => $file->category->base_dir_path,
            'title' => $file->title,
            'description' => $file->description,
            'mvfiles_specs' => $file->specs->toArray()
        ];

        $this->addTo('attr', $attr);
    }

}
