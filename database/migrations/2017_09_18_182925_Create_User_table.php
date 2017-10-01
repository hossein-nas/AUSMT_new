<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('au_user', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name',50)->nullable(false);
			$table->string('username',20)->unique()->nullable(false);
			$table->string('email',50)->unique()->nullable(false);
			$table->string('password',60)->nullable(false);
			$table->rememberToken();
			$table->timestamp('activated_at')->nullable();
			$table->boolean('activated')->nullable(false)->default(0);
			$table->integer('user_type_id')->unsigned()->nullable(false);
			$table->integer('thumbnail_id')->unsigned()->nullable(false);
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
		Schema::drop('au_user');
	}
}
