<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyFromAuFileGroupToAuRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('au_file_group', function (Blueprint $table) {
            $table->foreign('record_id')
	            ->references('id')
	            ->on('au_record');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('au_file_group', function (Blueprint $table) {
            $table->dropForeign(['record_id']);
        });
    }
}
