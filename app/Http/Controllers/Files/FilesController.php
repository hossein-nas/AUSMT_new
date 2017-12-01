<?php

namespace App\Http\Controllers\Files;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;

class FilesController extends Controller
{
    public function record_thumbnail(Request $requests){
        if ( $requests->hasFile('record_thumbnail') ){
            $filePath= $requests->file('record_thumbnail')->getRealPath();
            $file = file_get_contents($filePath);
            $ext = $requests->file('record_thumbnail')->extension();
            $orig_name = $requests->get('orign_name');
            $name = sha1($file);
            $path = '/files/images/record_thumbnails/';
            if( $p = $this->fileStore($file, $name, $ext, $path) )
                return Response::json([
                    'status' => 1,
                    'text' => 'تصویر با موفقیت بارگذاری شد.',
                    'url' => $p
                ]);
            else
                return Response::json([
                    'status' => 0,
                    'text' => 'متأسفانه،‌ تصویر با موفقیت بارگذاری نشد!',
                ]);
        }
    }

    public function upload(Request $requests){
        if ( $requests->hasFile('upload') ){
            $filePath= $requests->file('upload')->getRealPath();
            $file = file_get_contents($filePath);
            $ext = $requests->file('upload')->extension();
            $name = sha1($file) .'.'. $ext;
            $path = '/files/images/'.$name;
            Storage::disk('public')->put($path, $file);
            return Response::json(['status'=>'ok','url'=>$path]);
        }
    }

    private function fileStore($file, $name, $ext, $folderPath ){
        $fullName= $name . '.' . $ext;
        $fullPath= $folderPath . $fullName;
        try{
            Storage::disk('public')->put($fullPath, $file);
        }catch (Exception $e){
            return false;
        }
        return url('/') . $fullPath;
    }

    private function generateFilePathFromExtension($file, $ext){

    }
    public function browseFiles(){
        $files = File::files('media/fastmenu');
        return ($files);
    }
}
