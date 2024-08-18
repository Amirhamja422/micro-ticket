<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'cat_name' => "Cat one",
                'is_active' => "1",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cat_name' => "cat two",
                'is_active' => "1",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cat_name' => "cat three",
                'is_active' => "1",
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
