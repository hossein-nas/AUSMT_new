<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyOrgUnitIdToOrgRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('au_org_role', function (Blueprint $table) {
        	$table->foreign('org_unit_id')
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
        Schema::table('au_org_role', function (Blueprint $table) {
            $table->dropForeign(['org_unit_id']);
        });
    }
}
