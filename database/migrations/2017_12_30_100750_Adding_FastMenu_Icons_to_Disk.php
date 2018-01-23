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
            $name = substr($icon, $indexOfSlash + 1, $len);
            $file_orig_name = substr($icon, $indexOfSlash+1);
            $ext = substr($icon, $indexOfDot + 1);
            $data = [
                'filepath' => storage_path('app/') . $icon,
                'file_title' => $name,
                'file_description' => $name,
                'file_orig_name' => $file_orig_name,
                'ext' => $ext,
                'responsive_image' => 0,
                'cat_id' => 8
            ];
            $ret = (new \App\Http\Controllers\Files\FilesController())->saveNewFile($data);
            echo $ret->get('id')."\n";
        }
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
