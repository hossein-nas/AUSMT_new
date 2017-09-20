<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigationBarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_navigation_bar', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('title',30);
	        $table->text('uri');
	        $table->integer('lang_id')->unsigned()->nullable(false);
	        $table->integer('navbar_type_id')->unsigned()->nullable(false);
	        $table->integer('parent_id')->unsigned()->nullable();
	        $table->integer('prev')->unsigned()->nullable();
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
        Schema::drop('au_navigation_bar');
    }
}
