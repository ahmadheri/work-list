<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
          [
            'name' => 'Anita',
            'phone' => '085255667788',
            'email' => 'anita@gmail.com',
            'created_at' => now()
          ],
          [
            'name' => 'Mikita',
            'phone' => '085250567890',
            'email' => 'mikita@gmail.com',
            'created_at' => now()
          ]
        ]);
    }
}
