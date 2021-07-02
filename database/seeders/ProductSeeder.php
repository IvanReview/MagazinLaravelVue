<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'iPhone XI 64GB',
                'code' => 'iphone_11_64',
                'description' => 'Отличный продвинутый телефон с памятью на 64 gb',
                'price' => '1000',
                'category_id' => 4,
                'image' => 'images/1.jpg',
                'count' => rand(0,10),
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'iPhone X 256GB',
                'code' => 'iphone_x_256',
                'description' => 'Отличный продвинутый телефон с памятью на 256 gb',
                'price' => '1099',
                'category_id' => 4,
                'image' => 'images/12.jpg',
                'count' => rand(0,10),
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Redmi 7',
                'code' => 'redmi_7',
                'description' => 'Зачем платить за лишнее? Легендарный HTC One S',
                'price' => '449',
                'category_id' => 4,
                'image' => 'images/5.jpeg',
                'count' => rand(0,10),
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'iPhone 7',
                'code' => 'iphone_7',
                'description' => 'Отличный классический iPhone',
                'price' => '1722',
                'category_id' => 4,
                'image' => 'images/16.jpg',
                'count' => rand(0,10),
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Наушники Beats Audio',
                'code' => 'beats_audio',
                'description' => 'Отличный звук',
                'price' => '202',
                'category_id' => 6,
                'image' => 'images/4.jpg',
                'count' => rand(0,10),
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Камера Sony HC-V770',
                'code' => 'panasonic_hc-v770',
                'description' => 'Для серьёзной видео съемки нужна серьёзная камера. Panasonic HC-V770 для этих целей лучший выбор!',
                'price' => '2790',
                'category_id' => 5,
                'image' => 'images/2.jpg',
                'count' => rand(0,10),
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Кофемашина DeLongi',
                'code' => 'delongi',
                'description' => 'Хорошее утро начинается с хорошего кофе!',
                'price' => '852',
                'category_id' => 5,
                'image' => 'images/17.jpg',
                'count' => rand(0,10),
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Холодильник Haier',
                'code' => 'haier',
                'description' => 'Для большой семьи большой холодильник!',
                'price' => '2020',
                'category_id' => 5,
                'image' => 'images/14.jpg',
                'count' => rand(0,10),
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Блендер Moulinex',
                'code' => 'moulinex',
                'description' => 'Для самых смелых идей',
                'price' => '420',
                'category_id' => 5,
                'image' => 'images/8.jpg',
                'count' => rand(0,10),
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Мясорубка Bosch',
                'code' => 'bosch',
                'description' => 'Любите домашние котлеты? Вам определенно стоит посмотреть на эту мясорубку!',
                'price' => '920',
                'category_id' => 5,
                'image' => 'images/3.jpg',
                'count' => rand(0,10),
                'created_at' => Carbon::now()
            ],

            [
                'name' => 'Эксклюзив',
                'code' => 'bosch',
                'description' => 'Любите домашние котлеты? Вам определенно стоит посмотреть на эту мясорубку!',
                'price' => '720',
                'category_id' => 5,
                'image' => 'images/11.jpg',
                'count' => rand(0,10),
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
