<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // input multiple rows must be array of arrays. double [[]]

        DB::table('users')->insert([
          [
            'name' => 'Admin',
            'phone' => '085250995099',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'), // password
            'role' => 'admin',
            'remember_token' => Str::random(10),
            'created_at' => now()
          ],
          [
            'name' => 'Dani',
            'phone' => '085250515253',
            'email' => 'dani@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('dani'), // password
            'role' => 'karyawan',
            'remember_token' => Str::random(10),
            'created_at' => now()  
          ]
        ]);
    }
}
