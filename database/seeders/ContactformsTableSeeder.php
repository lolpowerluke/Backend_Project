<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactformsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contactforms')->insert([
            'title' => 'Contact Form',
            'email' => 'user@ehb.be',
            'message' => 'This is a test message',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('contactforms')->insert([
            'title' => 'Contact Form 2',
            'email' => 'lukas@gmail.com',
            'message' => 'This is a test message 2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
