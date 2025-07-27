<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'SQL Injection'],
            ['name' => 'XSS'],
            ['name' => 'CSRF'],
            ['name' => 'Konfigürasyon Hatası'],
            ['name' => 'Yetkilendirme Eksikliği'],
            ['name' => 'PHP'],
            ['name' => 'JavaScript'],
            ['name' => 'Apache'],
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate($tag);
        }
    }
}
