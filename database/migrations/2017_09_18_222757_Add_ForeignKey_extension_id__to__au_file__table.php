<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyExtensionIdToAuFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('au_file', function (Blueprint $table) {
            $table->foreign('extension_id')
	            ->references('id')
	            ->on('au_file_extension');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('au_file', function (Blueprint $table) {
            $table->dropForeign(['extension_id']);
        });
    }
}
