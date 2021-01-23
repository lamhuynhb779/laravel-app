<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Article::truncate();

        for ($i=0; $i < 50; $i++) { 
            Article::create([
                'title' => Str::random(10),
                'body' => Str::random(50),
            ]);
        }
    }
}
