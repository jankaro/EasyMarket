<?php

use Illuminate\Database\Seeder;

class SellersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Seller::create([
            'user_id'=>'1',
            'seller_name'=>'Doulaxx',
            'personal_picture'=>'assets/default.png',
            'national_id'=>'assets/product_default.png'
        ]);
    }
}
