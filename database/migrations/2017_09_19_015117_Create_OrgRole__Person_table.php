<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrgRolePersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_org_role__person', function (Blueprint $table) {
            $table->integer('person_id')->unsigned()->nullable(false);
            $table->integer('org_role_id')->unsigned()->nullable(false);
	        $table->timestamp('started_at')->nullable(false);
	        $table->timestamp('finished_at')->nullable();
	        $table->primary(['person_id', 'org_role_id', 'started_at']);
        });
	    
	    // adding foreign key for many to many between person and organizational role
	    Schema::table('au_org_role__person', function (Blueprint $table){
	    	$table->foreign('person_id')
			    ->references('id')
			    ->on('au_person');
		    
		    $table->foreign('org_role_id')
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
        Schema::drop('au_org_role__person');
    }
}
