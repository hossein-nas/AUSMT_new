<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMagGroupTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('au_publication_group', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title', 100)->nullable(false);
			$table->string('publisher', 20);
			$table->string('publication_period')->nullable();
			$table->string('description', 200);
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
		Schema::drop('au_publication_group');
	}
}
