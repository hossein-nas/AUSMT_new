<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCategoryTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('au_post_category', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name', 50)->nullable(false);
			$table->integer('parent_category_id')->unsigned()->nullable();
			$table->timestamps();
		});
		
		// adding recursive foreign key to table
		Schema::table('au_post_category', function(Blueprint $table){
			$table->foreign('parent_category_id')
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
		Schema::drop('au_post_category');
	}
}
