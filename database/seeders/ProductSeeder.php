<?php

namespace Database\Seeders;

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
                'price' => '71990',
                'category_id' => 4,
                'image' => 'products/iphone_x.jpg',
                'count' => rand(0,10),
            ],
            [
                'name' => 'iPhone X 256GB',
                'code' => 'iphone_x_256',
                'description' => 'Отличный продвинутый телефон с памятью на 256 gb',
                'price' => '89990',
                'category_id' => 4,
                'image' => 'products/iphone_x_silver.jpg',
                'count' => rand(0,10),
            ],
            [
                'name' => 'Redmi 7',
                'code' => 'redmi_7',
                'description' => 'Зачем платить за лишнее? Легендарный HTC One S',
                'price' => '12490',
                'category_id' => 4,
                'image' => 'products/htc_one_s.png',
                'count' => rand(0,10),
            ],
            [
                'name' => 'iPhone 7',
                'code' => 'iphone_7',
                'description' => 'Отличный классический iPhone',
                'price' => '17221',
                'category_id' => 4,
                'image' => 'products/iphone_5.jpg',
                'count' => rand(0,10),
            ],
            [
                'name' => 'Наушники Beats Audio',
                'code' => 'beats_audio',
                'description' => 'Отличный звук',
                'price' => '20221',
                'category_id' => 6,
                'image' => 'products/beats.jpg',
                'count' => rand(0,10),
            ],
            [
                'name' => 'Камера Panasonic HC-V770',
                'code' => 'panasonic_hc-v770',
                'description' => 'Для серьёзной видео съемки нужна серьёзная камера. Panasonic HC-V770 для этих целей лучший выбор!',
                'price' => '27900',
                'category_id' => 5,
                'image' => 'products/video_panasonic.jpg',
                'count' => rand(0,10),
            ],
            [
                'name' => 'Кофемашина DeLongi',
                'code' => 'delongi',
                'description' => 'Хорошее утро начинается с хорошего кофе!',
                'price' => '25200',
                'category_id' => 5,
                'image' => 'products/delongi.jpg',
                'count' => rand(0,10),
            ],
            [
                'name' => 'Холодильник Haier',
                'code' => 'haier',
                'description' => 'Для большой семьи большой холодильник!',
                'price' => '40200',
                'category_id' => 5,
                'image' => 'products/haier.jpg',
                'count' => rand(0,10),
            ],
            [
                'name' => 'Блендер Moulinex',
                'code' => 'moulinex',
                'description' => 'Для самых смелых идей',
                'price' => '4200',
                'category_id' => 5,
                'image' => 'products/moulinex.jpg',
                'count' => rand(0,10),
            ],
            [
                'name' => 'Мясорубка Bosch',
                'code' => 'bosch',
                'description' => 'Любите домашние котлеты? Вам определенно стоит посмотреть на эту мясорубку!',
                'price' => '9200',
                'category_id' => 5,
                'image' => 'products/bosch.jpg',
                'count' => rand(0,10),
            ],
        ]);
    }
}
