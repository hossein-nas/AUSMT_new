<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyRoomIdToRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('au_person', function (Blueprint $table) {
            $table->foreign('room_id')
	            ->references('id')
	            ->on('au_room');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('au_person', function (Blueprint $table) {
            $table->dropForeign(['room_id']);
        });
    }
}
