<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivilegeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_privilege', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('subject',50)->nullable(false);
	        $table->string('description',200)->nullable(false);
        });
	    
//	    DB::table('au_privilege')->insert([
//
//	    ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('au_privilege');
    }
}
