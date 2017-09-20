<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrgUnitStructureTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('au_org_unit__structure', function (Blueprint $table) {
			$table->integer('org_unit_id')->unsigned()->nullable(false);
			$table->integer('structure_id')->unsigned()->nullable(false);
			$table->timestamp('started_at')->nullable(false);
			$table->timestamp('finished_at')->nullable();
			$table->primary(['org_unit_id', 'structure_id', 'started_at'], 'org_unit_structure_start_primary_key');
		});
		
		Schema::table('au_org_unit__structure', function (Blueprint $table) {
			$table->foreign('org_unit_id')
				->references('id')
				->on('au_org_unit');
			
			$table->foreign('structure_id')
				->references('id')
				->on('au_structure');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('au_org_unit__structure');
	}
}
