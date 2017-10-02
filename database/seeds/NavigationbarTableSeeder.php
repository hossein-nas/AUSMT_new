<?php

use Illuminate\Database\Seeder;

class NavigationbarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $this->generateChild(5)->each(function($a){
                $this->generateChild(8,$a->id,3);
            });
    }

    public function generateChild($count,$parent = null, $navbar_type=1){
        $prev_id = null;
        $ret = collect();
        for ($i = 0; $i++ < $count;) {
            $tmp = factory(App\Models\Navigationbar::class)->create([
                'parent_id' => $parent,
                'prev' => $prev_id,
                'navbar_type_id'=>$navbar_type
            ]);
            $prev_id = $tmp->id;
            $ret->push($tmp);
        }
        return $ret;
    }
}
