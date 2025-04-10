<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create(
            [
                'name' => 'ahmed ',
                'email' => 'ahmed@gmail.com',
                'phone' => '12345678',
                'password' => bcrypt('ahmed1191'),
            ]);
    }
}
