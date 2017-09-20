<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToNavigationBarTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('au_navigation_bar', function (Blueprint $table) {
			$table->foreign('lang_id')
				->references('id')
				->on('au_language');
			
			$table->foreign('navbar_type_id')
				->references('id')
				->on('au_navbar_type');
			
			$table->foreign('prev')
				->references('id')
				->on('au_navigation_bar');
			
			$table->foreign('parent_id')
				->references('id')
				->on('au_navigation_bar');
			
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('au_navigation_bar', function (Blueprint $table) {
			$table->dropForeign(['lang_id']);
			$table->dropForeign(['navbar_type_id']);
			$table->dropForeign(['prev']);
			$table->dropForeign(['parent_id']);
		});
	}
}
