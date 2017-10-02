<?php

use Illuminate\Database\Seeder;

class FastmenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prev_id = null;
        for($i=0; $i++<25;){
            $tmp =factory(App\Models\Fastmenu::class)->create(['prev'=>$prev_id]);
            $prev_id = $tmp->id;
        }
    }
}
