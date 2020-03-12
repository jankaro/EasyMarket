<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Product::create([
            'user_id'=>'1',
            'category_id'=>'1',
            'price'=>'120',
            'product_title'=>'Samsung S20 ultra',
            'description'=>'the newst samsung mobile',
        ]);

        \App\Product::create([
            'user_id'=>'1',
            'category_id'=>'6',
            'price'=>'99',
            'product_title'=>'Audi car',
            'description'=>'the newst Audi car',
        ]);

        \App\Product::create([
            'user_id'=>'1',
            'category_id'=>'2',
            'price'=>'1000',
            'product_title'=>'T-shirt zara',
            'description'=>'the newst zara t-shirt',
        ]);
    }
}
