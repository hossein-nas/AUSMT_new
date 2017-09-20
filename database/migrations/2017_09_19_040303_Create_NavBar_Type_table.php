<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavBarTypeTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('au_navbar_type', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name', 40)->nullable(false);
			$table->string('name_fa', 40)->nullable(false);
		});
		
		DB::table('au_navbar_type')->insert([
			['name'=>'root', 'name_fa'=>'ریشه'],
			['name'=>'group', 'name_fa'=>'گروه'],
			['name'=>'child', 'name_fa'=>'فرزند']
		]);
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('au_navbar_type');
	}
}
