<?php

use App\Rate;
use Illuminate\Database\Seeder;

class RatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rate::create([
            'user_id'=>'1',
            'product_id'=>'2',
            'rate_value'=>'4',
            'feedback'=>'Feedback 1'
        ]);

        Rate::create([
            'user_id'=>'1',
            'product_id'=>'2',
            'rate_value'=>'4',
            'feedback'=>'feedback 2'
        ]);

        Rate::create([
            'user_id'=>'1',
            'product_id'=>'2',
            'rate_value'=>'2',
            'feedback'=>'feedback 3'
        ]);

        Rate::create([
            'user_id'=>'1',
            'product_id'=>'2',
            'rate_value'=>'5',
            'feedback'=>'feedback 4 '
        ]);

        Rate::create([
            'user_id'=>'1',
            'product_id'=>'2',
            'rate_value'=>'1',
            'feedback'=>'feedback 5'
        ]);

        Rate::create([
            'user_id'=>'1',
            'product_id'=>'2',
            'rate_value'=>'3',
            'feedback'=>'feedback 6 '
        ]);
    }
}
