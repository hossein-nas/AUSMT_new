<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingInitialTuplesForAuFileExtensionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $ret = \App\Models\Files\File_Extension::get();
        foreach ($ret as $ext) {
            $data = [
                'orig_name' => $ext->extension . '.svg',
                'ext' => 'svg',
                'basedir' => '/files/images/mimetype_icons',
                'name' => md5($ext->extension),
                'hashName' => md5($ext->extension) . '.svg',
                'sourcedir' => storage_path('app/') . 'filetypes',
                'is_responsive' => false,
                'is_image' => false,
            ];
            $ret = (new \App\Http\Controllers\Files\FilesController())->localFileToDB($data);
            $ext->file_icon_id = $ret['id'];
            $ext->save();
        }

        echo  ('File Extension Mimetype Icons Added Successfully ') . PHP_EOL;

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
