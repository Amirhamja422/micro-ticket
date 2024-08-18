<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'              => 'Abdul Alim',
                'email'             => 'aa@ihelpbd.com',
                'number'             => '01746733817',
                // 'department_id'     => rand(1, 3),
                'password'          => Hash::make('12345678'),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'name'              => 'M. Kiron',
                'email'             => 'kiron@ihelpbd.com',
                'number'             => '01746733817',
                // 'department_id'     => rand(1, 3),
                'password'          => Hash::make('12345678'),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            // [
            //     'name'              => 'Mehedi Hasan Shamim',
            //     'email'             => 'mehedi@ihelpbd.com',
            //     'number'             => '01746733817',
            //     // 'department_id'     => rand(1, 3),
            //     'password'          => Hash::make('12345678'),
            //     'created_at'        => now(),
            //     'updated_at'        => now(),
            // ],
            // [
            //     'name'              => 'Amir Hamza',
            //     'email'             => 'amir@ihelpbd.com',
            //     'number'             => '01746733817',
            //     // 'department_id'     => rand(1, 3),
            //     'password'          => Hash::make('12345678'),
            //     'created_at'        => now(),
            //     'updated_at'        => now(),
            // ],
            // [
            //     'name'              => 'Shakil Mahmud',
            //     'email'             => 'shakil@ihelpbd.com',
            //     'number'             => '01746733817',
            //     // 'department_id'     => rand(1, 3),
            //     'password'          => Hash::make('12345678'),
            //     'created_at'        => now(),
            //     'updated_at'        => now(),
            // ],
            // [
            //     'name'              => 'Nyem Hossain',
            //     'email'             => 'nyem@ihelpbd.com',
            //     'number'             => '01746733817',
            //     // 'department_id'     => rand(1, 3),
            //     'password'          => Hash::make('12345678'),
            //     'created_at'        => now(),
            //     'updated_at'        => now(),
            // ],
            // [
            //     'name'              => 'Shamim Hossain',
            //     'email'             => 'shamim@ihelpbd.com',
            //     'number'             => '01746733817',
            //     // 'department_id'     => rand(1, 3),
            //     'password'          => Hash::make('12345678'),
            //     'created_at'        => now(),
            //     'updated_at'        => now(),
            // ],
            // [
            //     'name'              => 'Mehedi Hasan',
            //     'email'             => 'hasan@ihelpbd.com',
            //     'number'             => '01746733817',
            //     // 'department_id'     => rand(1, 3),
            //     'password'          => Hash::make('12345678'),
            //     'created_at'        => now(),
            //     'updated_at'        => now(),
            // ],
            // [
            //     'name'              => 'AH Jacky',
            //     'email'             => 'jacky@ihelpbd.com',
            //     'number'             => '01746733817',
            //     // 'department_id'     => rand(1, 3),
            //     'password'          => Hash::make('12345678'),
            //     'created_at'        => now(),
            //     'updated_at'        => now(),
            // ],
            // [
            //     'name'              => 'Sk Nyem',
            //     'email'             => 'sk@ihelpbd.com',
            //     'number'             => '01746733817',
            //     // 'department_id'     => rand(1, 3),
            //     'password'          => Hash::make('12345678'),
            //     'created_at'        => now(),
            //     'updated_at'        => now(),
            // ],
            // [
            //     'name'              => 'Mahdi Pranto',
            //     'email'             => 'mahdi@ihelpbd.com',
            //     'number'             => '01746733817',
            //     // 'department_id'     => rand(1, 3),
            //     'password'          => Hash::make('12345678'),
            //     'created_at'        => now(),
            //     'updated_at'        => now(),
            // ],
            // [
            //     'name'              => 'Tasnif Khan Dip',
            //     'email'             => 'tasnif@ihelpbd.com',
            //     'number'             => '01746733817',
            //     // 'department_id'     => rand(1, 3),
            //     'password'          => Hash::make('12345678'),
            //     'created_at'        => now(),
            //     'updated_at'        => now(),
            // ],
            // [
            //     'name'              => 'Hasib Sobuj',
            //     'email'             => 'sobuj@ihelpbd.com',
            //     'number'             => '01746733817',
            //     // 'department_id'     => rand(1, 3),
            //     'password'          => Hash::make('12345678'),
            //     'created_at'        => now(),
            //     'updated_at'        => now(),
            // ],
            // [
            //     'name'              => 'Tania Farzana',
            //     'email'             => 'farjana@ihelpbd.com',
            //     'number'             => '01746733817',
            //     // 'department_id'     => rand(1, 3),
            //     'password'          => Hash::make('12345678'),
            //     'created_at'        => now(),
            //     'updated_at'        => now(),
            // ],
            // [
            //     'name'              => 'Rubel Hossain',
            //     'email'             => 'rubel@ihelpbd.com',
            //     'number'             => '01746733817',
            //     // 'department_id'     => rand(1, 3),
            //     'password'          => Hash::make('12345678'),
            //     'created_at'        => now(),
            //     'updated_at'        => now(),
            // ],
        ]);
    }
}
