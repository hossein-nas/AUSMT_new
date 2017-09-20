<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyFileGroupTypeIdToFileGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('au_file_group', function (Blueprint $table) {
            $table->foreign('file_group_type_id')
	            ->references('id')
	            ->on('au_file_group_type');
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
            $table->dropForeign(['file_group_type_id']);
        });
    }
}
