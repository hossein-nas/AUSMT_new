<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_slider', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('title',150)->nullable(false);
	        $table->string('description',250)->nullable(false);
	        $table->boolean('visibility')->nullable(false)->default(1);
	        $table->timestamp('expired_at')->nullable();
	        $table->integer('photo_id')->unsigned()->nullable(false);
	        $table->integer('record_id')->unsigned()->nullable(false);
	        $table->integer('lang_id')->unsigned()->nullable(false);
            $table->timestamps();
        });
	    
	    // add neccessary foreign key to 'au_slider' table
	    // related table:
	    // File, Record, Language
	    Schema::table('au_slider', function (Blueprint $table){
	    	$table->foreign('photo_id')
			    ->references('id')
			    ->on('au_file');
		    
		    $table->foreign('record_id')
			    ->references('id')
			    ->on('au_record');
		    
		    $table->foreign('lang_id')
			    ->references('id')
			    ->on('au_language');
		    
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('au_slider');
    }
}
