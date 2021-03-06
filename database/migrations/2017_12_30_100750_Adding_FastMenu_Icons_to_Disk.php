<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingFastMenuIconsToDisk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $all_Icons = Storage::disk('local')->files('fastmenu');
        foreach ($all_Icons as $icon) {
            $indexOfSlash = strrpos($icon, '/');
            $indexOfDot = strrpos($icon, '.');
            $len = $indexOfDot - $indexOfSlash - 1;
            $filename = substr($icon, $indexOfSlash + 1, $len);

            $data = [
                'orig_name' => $filename . '.svg',
                'ext' => 'svg',
                'basedir' => '/files/images/fastmenu_icons',
                'name' => md5($filename),
                'hashName' => md5($filename) . '.svg',
                'sourcedir' => storage_path('app/') . 'fastmenu',
                'is_responsive' => false,
                'is_image' => false,
            ];
            $ret = (new \App\Http\Controllers\Files\FilesController())->localFileToDB($data);
        }
        echo  ('Fastmenu Icons Added Successfully') . PHP_EOL;

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
