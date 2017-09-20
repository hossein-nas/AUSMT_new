<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_content', function (Blueprint $table) {
            $table->increments('id');
	        $table->text('content')->nullable(false);
	        $table->boolean('is_close')->nullable(false)->default(0);
	        $table->integer('page_id')->unsigned()->nullable(false);
	        $table->integer('content_type_id')->unsigned()->nullable(false);
	        $table->integer('prev')->unsigned()->nullable();
	        $table->integer('parent')->unsigned()->nullable();
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
        Schema::drop('au_content');
    }
}
