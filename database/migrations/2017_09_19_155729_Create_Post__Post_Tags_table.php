<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostPostTagsTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('au_post__tag', function (Blueprint $table) {
			$table->integer('post_id')->unsigned()->nullable(false);
			$table->integer('tag_id')->unsigned()->nullable(false);
			$table->primary(['post_id', 'tag_id']);
		});
		
		// adding foreign key to manage many-to-many relationship
		// between 'au_post' and 'au_tag'
		Schema::table('au_post__tag', function (Blueprint $table) {
			$table->foreign('post_id')
				->references('id')
				->on('au_post');
			
			$table->foreign('tag_id')
				->references('id')
				->on("au_tag");
			
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('au_post__tag');
	}
}
