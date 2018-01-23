<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingAColumnForForeignKeyOnMultiValueTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('au_file_multivalue', function (Blueprint $table) {
            $table->integer('related_file_id')->unsigned()->after('id');
            $table->dropForeign(['id']);
            $table->foreign('related_file_id')
                ->references('id')
                ->on('au_file');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('au_file_multivalue', function (Blueprint $table) {
            $table->dropForeign(['related_file_id']);
            $table->dropColumn('related_file_id');
        });
    }
}
