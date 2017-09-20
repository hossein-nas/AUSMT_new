<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationalRoleTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('au_org_role', function (Blueprint $table) {
			$table->increments('id');
			$table->string('role_title', 50)->nullable(false);
			$table->string('role_title_en', 50);
			$table->text('description')->nullable(false);
			$table->integer('superior_role_id')->unsigned()->nullable();
			$table->integer('org_unit_id')->unsigned()->nullable(false);
			$table->timestamps();
		});
		
		Schema::table('au_org_role',function(Blueprint $table){
			$table->foreign('superior_role_id')
				->references('id')
				->on('au_org_role');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('au_org_role');
	}
}
