<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trees')->insert([
            [
                'name' => 'Родитель 1',
                'parent_id' => 0,
            ],
            [
                'name' => 'Родитель 2',
                'parent_id' => 0,
            ],
            [
                'name' => 'Родитель 3',
                'parent_id' => 0,
            ],
            [
                'name' => 'Дочерний 1',
                'parent_id' => 1,
            ],
            [
                'name' => 'Дочерний 2',
                'parent_id' => 4,
            ],
            [
                'name' => 'Дочерний 3',
                'parent_id' => 5,
            ],
            [
                'name' => 'Дочерний 4',
                'parent_id' => 2,
            ],
            [
                'name' => 'Дочерний 5',
                'parent_id' => 3,
            ],
            [
                'name' => 'Дочерний 6',
                'parent_id' => 8,
            ],


        ]);
    }
}
