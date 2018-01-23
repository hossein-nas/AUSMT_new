<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_comment', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('name',30)->nullable(false);
	        $table->string('email',100);
	        $table->string('content',500)->nullable(false);
			$table->boolean('verified')->nullable(false)->default(0);
			$table->boolean('is_admin')->nullable(false)->default(0);
			$table->ipAddress('ip')->nullable(false);
	        $table->timestamp('verified_at')->nullable();
	        $table->integer('post_id')->unsigned()->nullable(false);
	        $table->integer('parent_cm_id')->unsigned()->nullable();
            $table->timestamps();
        });
	    
	    // adding some foreign key to table
	    // 1. self foreign key for parent child relationship in cm
	    // 2. foreign key to detect related post
	    Schema::table('au_comment', function(Blueprint $table){
	    	$table->foreign('parent_cm_id')
			    ->references('id')
			    ->on('au_comment');
		    
		    $table->foreign('post_id')
			    ->references('id')
			    ->on('au_post');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('au_comment');
    }
}
