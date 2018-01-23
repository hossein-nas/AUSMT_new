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
        $ret =\App\Models\Files\File_Extension::get();
        foreach($ret as $it){
            $ext = $it->extension;
            $related_file_path = storage_path('app/filetypes/') . $ext . '.svg';
            $data = [
                'filepath' => $related_file_path,
                'file_orig_name' => $ext . '.svg',
                'file_title' => strtoupper($ext),
                'file_description' => '',
                'cat_id' => 9,
                'ext' => 'svg',
                'responsive_image' => 0
            ];
            $ret = (new \App\Http\Controllers\Files\FilesController())->saveNewFile($data);
            $id = $ret->get('id');
            $it->file_icon_id = $id;
            $it->save();

        }
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
