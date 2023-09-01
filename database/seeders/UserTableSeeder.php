<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@ehb.be',
            'bio' => 'I am the admin of this website.',
            'birthday' => DateTime::createFromFormat('d/m/Y', '01/01/1800'),
            'password' => bcrypt('Password!123'),
            'image_name' => 'pfp-img1.jpg',
            'admin' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@ehb.be',
            'bio' => 'I am a user of this website.',
            'birthday' => DateTime::createFromFormat('d/m/Y', '01/01/2010'),
            'password' => bcrypt('Password!123'),
            'image_name' => '1693556834.png',
            'admin' => false,
            'created_at' => now(),
            'updated_at' => now(),
      ]);
    }
}
