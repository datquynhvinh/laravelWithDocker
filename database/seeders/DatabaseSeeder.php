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

        $groups = [
            [
                'id' => 1,
                'name' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        DB::table('groups')->insertOrIgnore($groups);

        $users = [
            [
                'id' => 1,
                'name' => 'Le Thac Dat 1',
                'email' => 'datquynhvinh1231@gmail.com',
                'password' => Hash::make('anhdat11'),
                'role_id' => 1,
                'group_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'name' => 'Le Thac Dat 2',
                'email' => 'datquynhvinh12311@gmail.com',
                'password' => Hash::make('anhdat11'),
                'role_id' => 0,
                'group_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'name' => 'Le Thac Dat 3',
                'email' => 'lethacdat@gmail.com',
                'password' => Hash::make('anhdat11'),
                'role_id' => 0,
                'group_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        DB::table('users')->insertOrIgnore($users);

        $products = [
            [
                'name' => 'Ban phim co Dimi Alice',
                'price' => 3500000,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Ban phim co Ajazz AC067',
                'price' => 2600000,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        DB::table('products')->insertOrIgnore($products);

        $posts = [
            [
                'title' => 'Post 1',
                'content' => 'Description 1',
                'user_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Post 2',
                'content' => 'Description 2',
                'user_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'title' => 'Post 3',
                'content' => 'Description 3',
                'user_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        DB::table('posts')->insertOrIgnore($posts);
    }
}
