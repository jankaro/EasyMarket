<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Order::create([
            'product_id'=>'1',
            'user_id'=>'1',
            'seller_id'=>'1',
            'payment_id'=>'1'

        ]);
    }
}
