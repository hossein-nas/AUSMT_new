<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileFileGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_file__file_group', function (Blueprint $table) {
            $table->integer('file_id')->unsigned();
            $table->integer('file_group_id')->unsigned();
	        $table->primary(['file_id', 'file_group_id']);
        });
	    
	    Schema::table('au_file__file_group',function(Blueprint $table){
	    	$table->foreign('file_id')
			    ->references('id')
			    ->on('au_file');
		    $table->foreign('file_group_id')
			    ->references('id')
			    ->on('au_file_group');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('au_file__file_group');
    }
}
