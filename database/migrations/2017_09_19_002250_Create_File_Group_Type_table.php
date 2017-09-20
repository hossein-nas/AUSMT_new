<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileGroupTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_file_group_type', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('name',20);
        });
	    
	    DB::table('au_file_group_type')->insert([
	    	['name' => 'attachment'],
	    	['name' => 'gallery']
	    ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('au_file_group_type');
    }
}
