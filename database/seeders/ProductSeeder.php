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
            'name' => 'Tennis ball',
            'price' => 20,
        ]);
        DB::table('products')->insert([
            'name' => 'Baseball bat',
            'price' => 250,
        ]);
        DB::table('products')->insert([
            'name' => 'Baseball gloves',
            'price' => 190,
        ]);
        DB::table('products')->insert([
            'name' => 'Football gloves',
            'price' => 170,
        ]);
        DB::table('products')->insert([
            'name' => 'Trick for training',
            'price' => 10,
        ]);
        DB::table('products')->insert([
            'name' => 'Training cone',
            'price' => 15,
        ]);
        DB::table('products')->insert([
            'name' => 'Gymnastic stick',
            'price' => 45,
        ]);

    }
}
