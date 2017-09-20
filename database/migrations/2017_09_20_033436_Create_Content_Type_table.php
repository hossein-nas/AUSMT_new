<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_content_type', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('name')->nullable(false);
	        $table->string('name_fa')->nullable(false);
        });
	    
	    // populating some initial information
	    DB::table('au_content_type')->insert([
	    	['name' => 'root_title', 'name_fa' => 'عنوان ریشه'],
	    	['name' => 'text', 'name_fa' => 'نوشته'],
	    	['name' => 'title', 'name_fa' => 'عنوان'],
	    ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('au_content_type');
    }
}
