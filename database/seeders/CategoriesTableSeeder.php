<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name'=>'Техника', 'code'=>'Tech', 'description'=>'Описание техники', 'parent_id'=>'0'],
            ['name'=>'Разное', 'code'=>'Different', 'description'=>'Разное', 'parent_id'=>'0'],
            ['name'=>'Одежда', 'code'=>'Clothes', 'description'=>'Одежда', 'parent_id'=>'0'],

            ['name'=>'Мобильные телефоны', 'code'=>'Mobiles', 'description'=>'Описание мобил' , 'parent_id'=>'1'],
            ['name'=>'Бытовая техника', 'code'=>'Appliances', 'description'=>'Описание бытовой техники', 'parent_id'=>'1'],
            ['name'=>'Аксесуары', 'code'=>'Accessory', 'description'=>'аксесуары', 'parent_id'=>'2'],
        ]);
    }
}
