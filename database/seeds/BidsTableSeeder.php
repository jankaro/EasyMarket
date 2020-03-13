<?php

use App\bid;
use Illuminate\Database\Seeder;

class BidsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        bid::create([
            'user_id'=>'1',
            'auction_id'=>'2',
            'value'=>'700'
        ]);
    }
}
