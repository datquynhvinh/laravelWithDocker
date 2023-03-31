<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insertOrIgnore([
            'name' => 'Le Thac Dat',
            'email' => 'datquynhvinh1231@gmail.com',
            'password' => Hash::make('anhdat11'),
            'group_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('products')->insertOrIgnore([
            'name' => 'Ban phim co Dimi Alice',
            'price' => 3500000,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ],);
        DB::table('products')->insertOrIgnore([
            'name' => 'Ban phim co Ajazz AC067',
            'price' => 2600000,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ],);
    }
}
