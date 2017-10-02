<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateUserPrivilegeTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_user__privilege', function (Blueprint $table) {
            $table->integer('user_type_id')->unsigned();
            $table->integer('privilege_id')->unsigned();
            $table->unique(['user_type_id', 'privilege_id']);
        });

        Schema::table('au_user__privilege', function (Blueprint $table) {
            $table->foreign('user_type_id')
                ->references('id')
                ->on('au_user_type');
        });
        Schema::table('au_user__privilege', function (Blueprint $table) {
            $table->foreign('privilege_id')
                ->references('id')
                ->on('au_privilege');
        });

        $tuples = [
            ['user_type_id' => 1, 'privilege_id' => 1],
            ['user_type_id' => 1, 'privilege_id' => 5],
            ['user_type_id' => 1, 'privilege_id' => 9],
            ['user_type_id' => 1, 'privilege_id' => 10],
            ['user_type_id' => 1, 'privilege_id' => 11],
            ['user_type_id' => 1, 'privilege_id' => 12],
            ['user_type_id' => 1, 'privilege_id' => 14],
            ['user_type_id' => 1, 'privilege_id' => 15],
            ['user_type_id' => 1, 'privilege_id' => 16],
            ['user_type_id' => 1, 'privilege_id' => 17],
            ['user_type_id' => 1, 'privilege_id' => 18],
            ['user_type_id' => 1, 'privilege_id' => 19],
            ['user_type_id' => 1, 'privilege_id' => 20],
            ['user_type_id' => 1, 'privilege_id' => 21],
            ['user_type_id' => 1, 'privilege_id' => 22],
            ['user_type_id' => 1, 'privilege_id' => 51],
            ['user_type_id' => 1, 'privilege_id' => 52],
            ['user_type_id' => 1, 'privilege_id' => 57],
            ['user_type_id' => 1, 'privilege_id' => 58],

            ['user_type_id' => 2, 'privilege_id' => 1 ],
            ['user_type_id' => 2, 'privilege_id' => 5 ],
            ['user_type_id' => 2, 'privilege_id' => 9 ],
            ['user_type_id' => 2, 'privilege_id' => 10 ],
            ['user_type_id' => 2, 'privilege_id' => 11 ],
            ['user_type_id' => 2, 'privilege_id' => 12 ],
            ['user_type_id' => 2, 'privilege_id' => 14 ],
            ['user_type_id' => 2, 'privilege_id' => 15 ],
            ['user_type_id' => 2, 'privilege_id' => 16 ],
            ['user_type_id' => 2, 'privilege_id' => 17 ],
            ['user_type_id' => 2, 'privilege_id' => 18 ],
            ['user_type_id' => 2, 'privilege_id' => 19 ],
            ['user_type_id' => 2, 'privilege_id' => 20 ],
            ['user_type_id' => 2, 'privilege_id' => 21 ],
            ['user_type_id' => 2, 'privilege_id' => 22 ],
            ['user_type_id' => 2, 'privilege_id' => 51 ],
            ['user_type_id' => 2, 'privilege_id' => 53 ],
            ['user_type_id' => 2, 'privilege_id' => 63 ],
            ['user_type_id' => 2, 'privilege_id' => 64 ],
            ['user_type_id' => 2, 'privilege_id' => 55 ],
            ['user_type_id' => 2, 'privilege_id' => 56 ],
            ['user_type_id' => 2, 'privilege_id' => 57 ],
            ['user_type_id' => 2, 'privilege_id' => 58 ],

            ['user_type_id' => 4, 'privilege_id' => 51 ],
            ['user_type_id' => 4, 'privilege_id' => 53 ],
            ['user_type_id' => 4, 'privilege_id' => 55 ],
            ['user_type_id' => 4, 'privilege_id' => 56 ],

            ['user_type_id' => 5, 'privilege_id' => 57 ],
            ['user_type_id' => 5, 'privilege_id' => 59 ],
            ['user_type_id' => 5, 'privilege_id' => 61 ],
            ['user_type_id' => 5, 'privilege_id' => 62 ],

            ['user_type_id' => 6, 'privilege_id' => 12 ],
            ['user_type_id' => 6, 'privilege_id' => 14 ],

            ['user_type_id' => 7, 'privilege_id' => 15 ],
            ['user_type_id' => 7, 'privilege_id' => 16 ],
            ['user_type_id' => 7, 'privilege_id' => 17 ],
            ['user_type_id' => 7, 'privilege_id' => 18 ],
            ['user_type_id' => 7, 'privilege_id' => 19 ],
            ['user_type_id' => 7, 'privilege_id' => 20 ],
            ['user_type_id' => 7, 'privilege_id' => 21 ],
            ['user_type_id' => 7, 'privilege_id' => 22 ],

            ['user_type_id' => 3, 'privilege_id' => 1 ],
            ['user_type_id' => 3, 'privilege_id' => 5 ],
            ['user_type_id' => 3, 'privilege_id' => 9 ],
            ['user_type_id' => 3, 'privilege_id' => 10 ],
            ['user_type_id' => 3, 'privilege_id' => 11 ],
            ['user_type_id' => 3, 'privilege_id' => 33 ],

            ['user_type_id' => 8, 'privilege_id' => 2 ],
            ['user_type_id' => 8, 'privilege_id' => 23 ],
            ['user_type_id' => 8, 'privilege_id' => 25 ],
            ['user_type_id' => 8, 'privilege_id' => 33 ],

            ['user_type_id' => 9, 'privilege_id' => 4 ],
            ['user_type_id' => 9, 'privilege_id' => 29 ],
            ['user_type_id' => 9, 'privilege_id' => 31 ],

            ['user_type_id' => 10, 'privilege_id' => 3 ],
            ['user_type_id' => 10, 'privilege_id' => 10 ],
            ['user_type_id' => 10, 'privilege_id' => 11 ],
            ['user_type_id' => 10, 'privilege_id' => 26 ],
            ['user_type_id' => 10, 'privilege_id' => 28 ],
        ];

        DB::table('au_user__privilege')->insert($tuples);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('au_user__privilege');
    }
}
