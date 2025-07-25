<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allTags = Tag::all();

        Blog::factory(30)
            ->create()
            ->each(function ($blog) use ($allTags) {
              $randomTags = $allTags->random(rand(1, 5));

              $blog->tags()->attach($randomTags);
            });
        
        // setiap blog dapet random 1-5 tag
    }
}
