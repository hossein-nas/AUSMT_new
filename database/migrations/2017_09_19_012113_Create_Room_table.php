<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_room', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('room_title')->nullable(false);
	        $table->integer('room_number');
	        $table->integer('struct_floor')->nullable(false);
	        $table->string('description',200);
	        $table->integer('structure_id')->unsigned()->nullable(false);
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
        Schema::drop('au_room');
    }
}
