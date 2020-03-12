<?php

use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Payment::create([
            'user_id'=>'1',
            'card_name'=>'Ahmed Adel',
            'card_number'=>'123400001234',
            'expiration_month'=>'09',
            'expiration_year'=>'22',
            'cvv'=>'123'

        ]);
    }
}
