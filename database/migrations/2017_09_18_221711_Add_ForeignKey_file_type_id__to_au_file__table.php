<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyFileTypeIdToAuFileTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('au_file', function (Blueprint $table) {
			$table->foreign('file_type_id')
				->references('id')
				->on('au_file_type');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('au_file', function (Blueprint $table) {
			$table->dropForeign(['file_type_id']);
		});
	}
}
