<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('news')->insert([
            'title' => 'News Item 1',
            'short_desc' => 'Short description for news item 1',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam cupiditate harum laudantium, consequuntur atque incidunt!',
            'user_id' => 1,
            'image_name' => '1693156610-1st image upload.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('news')->insert([
            'title' => 'News Item 2',
            'short_desc' => 'Short description for news item 2',
            'content' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus rem atque amet laborum veritatis commodi iste laboriosam minima exercitationem non!',
            'user_id' => 2,
            'image_name' => '1693206799-2nd image upload.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
