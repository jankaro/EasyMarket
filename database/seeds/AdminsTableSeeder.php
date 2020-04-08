<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Admin::create([
            'user_id'=>'1',
            'name'=>'Doula',
            'is_active'=>true
        ]);
    }
}
