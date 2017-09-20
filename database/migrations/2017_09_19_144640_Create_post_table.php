<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_post', function (Blueprint $table) {
            $table->integer('id')->unsigned()->nullable(false)->primary();
	        $table->text('content')->nullable(false);
	        $table->boolean('is_important');
        });
	    
	    //add foreign key to one-to-one relation with 'au_record' table
	    Schema::table('au_post', function(Blueprint $table) {
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
        Schema::drop('au_post');
    }
}
