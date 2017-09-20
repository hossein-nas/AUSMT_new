<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_visit', function (Blueprint $table) {
        	$table->increments('id');
        	$table->integer('record_id')->unsigned()->nullable();
	        $table->ipAddress('ip')->nullable(false);
	        $table->string('uri',300);
	        $table->string('redirect_uri',300);
	        $table->string('user_agent',200);
	        $table->integer('request_time');
            $table->timestamps();
        });
	    
	    // adding foreign key to 'au_record' table
	    Schema::table('au_visit' , function (Blueprint $table){
	    	$table->foreign('record_id')
			    ->references('id')
			    ->on('au_record');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('au_visit');
    }
}
