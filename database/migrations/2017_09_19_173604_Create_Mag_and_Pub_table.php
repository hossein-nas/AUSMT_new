<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMagAndPubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_mag_and_pub', function (Blueprint $table) {
            $table->integer('id')->primary()->unsigned()->nullable(false);
	        $table->string('title')->nullable(false);
	        $table->text('description')->nullable(false);
	        $table->integer('pub_no');
	        $table->integer('publication_group_id')->unsigned()->nullable();
        });
	    
	    // adding foreign key to 'au_publication_group' table
	    Schema::table('au_mag_and_pub',function(Blueprint $table){
	    	$table->foreign('publication_group_id')
			    ->references('id')
			    ->on('au_publication_group');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('au_mag_and_pub');
    }
}
