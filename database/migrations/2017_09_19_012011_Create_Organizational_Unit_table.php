<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationalUnitTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('au_org_unit', function (Blueprint $table) {
			$table->increments('id');
			$table->string('unit_title', 50)->nullable(false);
			$table->string('unit_title_en', 50);
			$table->text('description')->nullable(false);
			$table->integer('super_org_unit_id')->unsigned()->nullable();
			$table->timestamps();
		});
		
		Schema::table('au_org_unit', function (Blueprint $table){
			$table->foreign('super_org_unit_id')
				->references('id')
				->on('au_org_unit');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('au_org_unit');
	}
}
