<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostPostCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_post__post_category', function (Blueprint $table) {
            $table->integer('post_id')->unsigned()->nullable(false);
	        $table->integer('post_category_id')->unsigned()->nullable(false);
	        $table->primary(['post_id', 'post_category_id']);
        });
	    
	    // adding to foregin key to 'au_post' and 'au_post_category'
	    // for managing many-to-many relation
	    Schema::table('au_post__post_category', function(Blueprint $table){
	    	$table->foreign('post_id')
			    ->references('id')
			    ->on('au_post');
		    
		    $table->foreign('post_category_id')
			    ->references('id')
			    ->on('au_post_category');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('au_post__post_category');
    }
}
