<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
          'task_id' => 1,
          'price' => 100000,
          'payment_method' => 'transfer',
          'down_payment' => 50000,
          'paid_amount' => 50000,
          'total' => 100000,
          'created_at' => now()
        ]);
    }
}
