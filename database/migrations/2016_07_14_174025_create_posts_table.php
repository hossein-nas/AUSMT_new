<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('posts')) {
            return ;
        }
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('hifen_title')->unique();
            $table->text('content');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
            $table->integer('post_type')->unsigned();
            // 1 -> post
            // 2 -> page
            // 3 -> notification
            // 4 -> seminar
            // 5 -> other
            $table->string('image')->nullable();
            $table->integer('visit')->default(0);
            $table->tinyInteger('addToSlider')->default(0);
            $table->tinyInteger('priority')->default(0);
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
        Schema::drop('posts');
    }
}
