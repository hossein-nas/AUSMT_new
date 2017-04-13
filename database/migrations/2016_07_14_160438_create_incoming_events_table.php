<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomingEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('incoming_events')) {
            return ;
        }
        Schema::create('incoming_events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('hifen_title');
            $table->text('content');
            $table->integer('user_id')->unsigned();
            $table->timestamp('expired_date');
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
        Schema::drop('incoming_events');
    }
}
