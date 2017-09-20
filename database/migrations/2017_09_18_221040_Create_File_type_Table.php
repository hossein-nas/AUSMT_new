<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_file_type', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('name')->uinque();
	        $table->string('name_fa')->uinque();
        });
	    
	    DB::table('au_file_type')->insert([
	    	['name' => 'Image', 'name_fa' => 'تصویر'],
	    	['name' => 'Video', 'name_fa' => 'ویدئو'],
	    	['name' => 'Audio', 'name_fa' => 'صوت'],
	    	['name' => 'Document', 'name_fa' => 'سند'],
	    	['name' => 'MISC', 'name_fa' => 'متفرقه']
	    ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('au_file_type');
    }
}
