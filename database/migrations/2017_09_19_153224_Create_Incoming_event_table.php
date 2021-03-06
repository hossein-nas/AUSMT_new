<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomingEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_incoming_event', function (Blueprint $table) {
	        $table->integer('id')->primary()->unsigned()->nullable(false);
	        $table->string('spot',150)->nullable(false);
	        $table->timestamp('started_at')->nullable(false);
	        $table->timestamp('finished_at');
        });
	
	    // add foreign key to one-to-one relation betwen post and seminar
	    Schema::table('au_incoming_event', function(Blueprint $table){
		    $table->foreign('id')
			    ->references('id')
			    ->on('au_post');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('au_incoming_event');
    }
}
