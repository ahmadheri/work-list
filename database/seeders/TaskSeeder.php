<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
          'user_id' => 1,
          'customer_id' => 1,
          'title' => 'pembuatan kartu nama 100 pcs',
          'quantity' => 50,
          'executor' => 'pcid',
          'deadline' => date("Y-m-d h:i:s", mktime(17,0,0,11,10,2022)),
          'invoice_number' => '0021',
          'created_at' => now()
        ]);
    }
}
