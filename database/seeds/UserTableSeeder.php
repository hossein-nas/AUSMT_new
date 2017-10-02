<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Files\File::class,20)->create()->each(function($a){
            factory(App\Models\Users\User::class)->create(['thumbnail_id'=>$a->id]);
            factory(App\Models\Files\File_MultiValue::class)->create(['id'=>$a->id]);
        });
    }
}
