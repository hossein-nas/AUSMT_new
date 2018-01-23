<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_file', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('orig_name', 60)->nullable(false);
	        $table->string('name', 40)->unique()->nullable(false);
	        $table->string('title', 60)->nullable(false)->default('بدون عنوان');
	        $table->string('description', 200)->nullable();
	        $table->boolean('responsive_image')->default(0)->nullable(false);
	        $table->integer('extension_id')->unsigned()->nullable(false);
	        $table->integer('file_category_id')->unsigned()->nullable(false);
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
        Schema::drop('au_file');
    }
}
