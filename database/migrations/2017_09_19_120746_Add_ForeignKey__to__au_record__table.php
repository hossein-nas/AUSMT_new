<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToAuRecordTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('au_record', function (Blueprint $table) {
			$table->foreign('record_type_id')
				->references('id')
				->on('au_record_type');
			
			$table->foreign('thumbnail_id')
				->references('id')
				->on('au_file');
			
			$table->foreign('user_id')
				->references('id')
				->on('au_user');
			
			$table->foreign('lang_id')
				->references('id')
				->on('au_language');
			
			


        });
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('au_record', function (Blueprint $table) {
			$table->dropForeign(['record_type_id']);
			$table->dropForeign(['thumbnail_id']);
			$table->dropForeign(['user_id']);
			$table->dropForeign(['lang_id']);
		});
	}
}
