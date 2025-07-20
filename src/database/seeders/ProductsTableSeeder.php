<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            ['name' => 'キウイ', 'price' => 800, 'image' => 'kiwi.jpg'],
            ['name' => 'ストロベリー', 'price' => 1200, 'image' => 'strawberry.jpg'],
            ['name' => 'オレンジ', 'price' => 850, 'image' => 'orange.jpg'],
            ['name' => 'スイカ', 'price' => 700, 'image' => 'watermelon.jpg'],
            ['name' => 'ピーチ', 'price' => 1000, 'image' => 'peach.jpg'],
            ['name' => 'シャインマスカット', 'price' => 1400, 'image' => 'muscat.jpg'],
            ['name' => 'パイナップル', 'price' => 900, 'image' => 'pineapple.jpg'],
            ['name' => 'ブドウ', 'price' => 1500, 'image' => 'grapes.jpg'],
            ['name' => 'バナナ', 'price' => 1100, 'image' => 'banana.jpg'],
            ['name' => 'メロン', 'price' => 950, 'image' => 'melon.jpg'],
        ]);
    }
}
