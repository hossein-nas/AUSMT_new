<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_language', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('lang_name',20)->nullable(false);
	        $table->string('lang_name_en',20)->nullable(false);
        });
	    
	    DB::table('au_language')->insert([
	    	['lang_name'=>'فارسی', 'lang_name_en'=>'Persian'],
	    	['lang_name'=>'انگلیسی', 'lang_name_en'=>'English']
	    ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('au_language');
    }
}
