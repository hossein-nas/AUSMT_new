<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStructureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_structure', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('name',50)->nullable(false);
	        $table->integer('floor_count')->nullable(false);
	        $table->string('address',200)->nullable(false);
	        $table->string('google_map',200);
	        $table->text('description',200)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('au_structure');
    }
}
