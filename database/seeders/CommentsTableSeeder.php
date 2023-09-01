<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comments')->insert([
            'user_id' => 1,
            'question_id' => 1,
            'content' => 'This is a comment',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        //add more comments here
        DB::table('comments')->insert([
            'user_id' => 2,
            'question_id' => 1,
            'content' => 'This is another comment',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('comments')->insert([
            'user_id' => 1,
            'question_id' => 2,
            'content' => 'This is a comment',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('comments')->insert([
            'user_id' => 2,
            'question_id' => 2,
            'content' => 'This is another comment',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
