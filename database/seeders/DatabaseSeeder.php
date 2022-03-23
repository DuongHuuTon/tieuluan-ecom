<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        $data = [
            [
                'name' => 'Admin',
                'address' => 'Cần Thơ',
                'phone' => '0834959800',
                'email' => 'admin@gmail.com',
                'status' => 1,
                'user_type' => 1,
                'rand_id' => rand(111111111, 999999999),
                "is_verify" => 0,
                'password' => bcrypt('admin123'),
            ],
        ];

        DB::table('users')->insert($data);
    }
}
