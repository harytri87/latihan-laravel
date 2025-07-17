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
        // Ngambil 3 tag random dari yg udh ada di database
        $tags = Tag::inRandomOrder()->take(3)->get();

        // Harus udh ada data user di database. Cek Blog factory.
        Blog::factory(30)
            ->hasAttached($tags)
            ->create();
    }
}
