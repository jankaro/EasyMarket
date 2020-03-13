<?php

use App\auction;
use Illuminate\Database\Seeder;

class AuctionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        auction::create([
            'user_id'=>'1',
            'product_id'=>'2',
            'start_price'=>'400',
            'desired_price'=>'1000',
            'end_date'=>'2020-03-20'
        ]);

        auction::create([
            'user_id'=>'1',
            'product_id'=>'3',
            'start_price'=>'200',
            'desired_price'=>'1000',
            'end_date'=>'2020-03-15'
        ]);
    }
}
