<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateUserPrivilegeTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('au_user__privilege', function (Blueprint $table) {
			$table->integer('user_type_id')->unsigned();
			$table->integer('privilege_id')->unsigned();
			$table->unique(['user_type_id', 'privilege_id']);
		});
		
		Schema::table('au_user__privilege', function (Blueprint $table) {
			$table->foreign('user_type_id')
				->references('id')
				->on('au_user_type');
		});
		Schema::table('au_user__privilege', function (Blueprint $table) {
			$table->foreign('privilege_id')
				->references('id')
				->on('au_privilege');
		});
		
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('au_user__privilege');
	}
}
