<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToAuContentTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('au_content', function (Blueprint $table) {
			Schema::table('au_content', function (Blueprint $table) {
				$table->foreign('page_id')
					->references('id')
					->on('au_page');
				
				$table->foreign('parent')
					->references('id')
					->on('au_content');
				
				$table->foreign('prev')
					->references('id')
					->on('au_content');
				
				$table->foreign('content_type_id')
					->references('id')
					->on('au_content_type');
			});
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('au_content', function (Blueprint $table) {
			$table->dropForeign(['page_id']);
			$table->dropForeign(['parent']);
			$table->dropForeign(['prev']);
			$table->dropForeign(['content_type_id']);
		});
	}
}
