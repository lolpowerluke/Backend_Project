<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('about')->insert([
            'resource' => 'laravel',
            'link' => 'https://laravel.com/',
        ]);
        DB::table('about')->insert([
            'resource' => 'PHP',
            'link' => 'https://www.php.net/',
        ]);
        DB::table('about')->insert([
            'resource' => 'MySQL',
            'link' => 'https://www.mysql.com/',
        ]);
        DB::table('about')->insert([
            'resource' => 'Bootstrap',
            'link' => 'https://getbootstrap.com/',
        ]);
        DB::table('about')->insert([
            'resource' => 'Vue.js',
            'link' => 'https://vuejs.org/',
        ]);
        DB::table('about')->insert([
            'resource' => 'Vite',
            'link' => 'https://vitejs.dev/',
        ]);
        DB::table('about')->insert([
            'resource' => 'laravel/ui',
            'link' => 'https://github.com/laravel/ui',
        ]);
        DB::table('about')->insert([
            'resource' => 'Auth',
            'link' => 'https://laravel.com/docs/10.x/authentication',
        ]);
        DB::table('about')->insert([
            'resource' => 'GitHub',
            'link' => 'https://github.com/lolpowerluke/Backend_Project',
        ]);
    }
}
