<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    /**
     * These are all example questions, I had no inspiration for real questions that make sense.
     */
    public function run(): void
    {
        DB::table('questions')->insert([
            'title' => 'What is the meaning of life?',
            'user_id' => 1,
            'content' => 'The meaning of life is to give life meaning.',
            'is_faq' => true,
            'categorie_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        //add more questions hereµ
        DB::table('questions')->insert([
            'title' => 'How do I get rich?',
            'user_id' => 2,
            'content' => 'You can get rich by working hard.',
            'is_faq' => false,
            'categorie_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('questions')->insert([
            'title' => 'How do I become a web developer?',
            'user_id' => 1,
            'content' => 'You can become a web developer by learning to code.',
            'is_faq' => true,
            'categorie_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('questions')->insert([
            'title' => 'How do I become a web designer?',
            'user_id' => 2,
            'content' => 'You can become a web designer by learning to design.',
            'is_faq' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('questions')->insert([
            'title' => 'How do I save money?',
            'user_id' => 1,
            'content' => 'You can save money by not spending it.',
            'is_faq' => true,
            'categorie_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
