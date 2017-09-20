<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_page', function (Blueprint $table) {
            $table->integer('id')->primary()->unsigned()->nullable(false);
        });
	    
	    // add foreign key for one-to-one relation between
	    // 'au_record' and 'au_page'
	    Schema::table('au_page', function(Blueprint $table){
	    	$table->foreign('id')
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
        Schema::drop('au_page');
    }
}
