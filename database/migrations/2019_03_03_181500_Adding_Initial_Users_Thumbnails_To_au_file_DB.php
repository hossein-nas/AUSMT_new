<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingInitialUsersThumbnailsToAuFileDB extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // adding useers general thumbnails to db
        $all_Icons = Storage::disk('local')->files('users_svg');
        foreach ($all_Icons as $icon) {
            $indexOfSlash = strrpos($icon, '/');
            $indexOfDot = strrpos($icon, '.');
            $len = $indexOfDot - $indexOfSlash - 1;
            $filename = substr($icon, $indexOfSlash + 1, $len);
            $data = [
                'orig_name' => $filename . '.svg',
                'ext' => 'svg',
                'basedir' => '/files/images/users_thumbnails',
                'name' => md5($filename),
                'hashName' => md5($filename) . '.svg',
                'sourcedir' => storage_path('app/') . 'users_svg',
                'is_responsive' => false,
                'is_image' => false,
            ];
            $ret = (new \App\Http\Controllers\Files\FilesController())->localFileToDB($data);
        }
        echo  ('Users Icons Added Successfully') . PHP_EOL;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
