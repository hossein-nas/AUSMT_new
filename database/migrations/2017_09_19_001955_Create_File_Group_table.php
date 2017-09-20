<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_file_group', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('title', 50);
	        $table->integer('file_group_type_id')->unsigned();
	        $table->integer('record_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('au_file_group');
    }
}
