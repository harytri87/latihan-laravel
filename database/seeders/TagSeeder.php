<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::factory()
            ->count(12)
            ->sequence(
                ['name' => 'Travel'],
                ['name' => 'Kuliner'],
                ['name' => 'Fashion'],
                ['name' => 'Hobi'],
                ['name' => 'Film'],
                ['name' => 'Musik'],
                ['name' => 'Game'],
                ['name' => 'Motivasi'],
                ['name' => 'Tips Belajar'],
                ['name' => 'Pendidikan'],
                ['name' => 'Karir'],
                ['name' => 'Info Menarik'],
            )
            ->create();
    }
}
