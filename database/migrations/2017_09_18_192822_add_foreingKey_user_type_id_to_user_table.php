<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingKeyUserTypeIdToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('au_user', function (Blueprint $table) {
            $table  ->foreign('user_type_id')
	                ->references('id')
	                ->on('au_user_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('au_user', function (Blueprint $table) {
            $table->dropForeign(['user_type_id']);
        });
    }
}
