<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('au_person', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('id_code')->unique()->nullable(false);
			$table->string('name', 50)->nullable(false);
			$table->string('email', 50)->nullable(false);
			$table->string('personal_homepage', 100)->nullable();
			$table->string('telephone', 10);
			$table->string('extension', 4);
			$table->string('bio', 300);
			$table->integer('thumbnail_id')->unsigned()->nullable();
			$table->integer('room_id')->unsigned()->nullable();
			$table->timestamps();
		});
		
		Schema::table("au_person", function(Blueprint $table){
			$table->foreign('thumbnail_id')
				->references('id')
				->on("au_file");
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('au_person');
	}
}
