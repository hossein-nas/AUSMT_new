<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFastmenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_fastmenu', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('title',40)->nullable(false);
	        $table->text('uri')->nullable(false);
	        $table->integer('lang_id')->unsigned();
	        $table->integer('svg_icon_id')->unsigned();
	        $table->integer('prev')->unique()->unsigned()->nullable();
            $table->timestamps();
        });
	    
	    // adding foreign key to 'au_language', 'au_file' for svg icon and recursive
	    // key to manage elems ordering and sorts
	    Schema::table('au_fastmenu', function(Blueprint $table){
	    	$table->foreign('lang_id')
			    ->references('id')
			    ->on('au_language');
		    
		    $table->foreign('svg_icon_id')
			    ->references('id')
			    ->on('au_file');
		    
		    $table->foreign('prev')
			    ->references('id')
			    ->on('au_fastmenu');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('au_fastmenu');
    }
}
