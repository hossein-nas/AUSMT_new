<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_user_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50)->nullable(false);
            $table->string('name_en',50)->nullable(false);
            $table->boolean('removable')->nullable(false)->default(1);
        });
        
        // insert some intial tuple to 'au_user_type' table
        DB::table('au_user_type')->insert([
            [
                'name' => 'مدیر کل',
                'name_en' => 'adminstrator',
                'removable' => 0
            ],
            [
                'name' => 'مدیر',
                'name_en' => 'manager',
                'removable' => 0
            ],
            [
                'name' => 'نویسنده',
                'name_en' => 'writer',
                'removable' => 0
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('au_user_type');
    }
}
