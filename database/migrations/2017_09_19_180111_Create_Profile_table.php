<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_profile_page', function (Blueprint $table) {
            $table->integer('id')->primary()->unsigned()->nullable(false);
            $table->integer('person_id')->unsigned()->nullable(false)->unique();
        });
	    
	    //ading foreign key to 'au_page' and 'au_person'
	    Schema::table('au_profile_page', function(Blueprint $table){
	    	$table->foreign('id')
			    ->references('id')
			    ->on('au_page');
		    
		    $table->foreign('person_id')
			    ->references('id')
			    ->on('au_person');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('au_profile_page');
    }
}
