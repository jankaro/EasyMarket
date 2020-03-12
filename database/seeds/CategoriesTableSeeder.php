<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Category::create([
            'title' => 'Mobile & Tablets'
        ]);

        \App\Category::create([
            'title' => 'Electronics'
        ]);

        \App\Category::create([
            'title' => 'Cars & Bikes'
        ]);

        \App\Category::create([
            'title' => 'Fashion & Beauty'
        ]);

        \App\Category::create([
            'title' => 'Food & Supplies'
        ]);

        \App\Category::create([
            'title' => 'Other'
        ]);

    }
}
