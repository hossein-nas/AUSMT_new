<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileMultiValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_file_multivalue', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('file_fullpath',500)->unique()->nullable(false);
	        $table->string('ratio',5);
	        $table->integer('filesize')->nullable(false);
	        $table->integer('width');
	        $table->integer('height');
        });
	    
	    Schema::table('au_file_multivalue', function (Blueprint $table){
	    	$table->foreign('id')
			    ->references('id')
			    ->on('au_file');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('au_file_multivalue');
    }
}
