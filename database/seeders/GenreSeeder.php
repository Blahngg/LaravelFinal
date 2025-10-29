<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            'Pop',
            'Rock',
            'Hip Hop',
            'R&B',
            'Jazz',
            'Blues',
            'Country',
            'Classical',
            'Electronic',
            'Dance',
            'Reggae',
            'Metal',
            'Punk',
            'Folk',
            'Indie',
            'Alternative',
            'Soul',
            'Gospel',
            'K-Pop',
            'J-Pop',
            'Latin',
            'Afrobeat',
            'Funk',
            'Disco',
            'House',
            'Techno',
            'Trance',
            'Dubstep',
            'Lo-fi',
            'Instrumental',
            'Soundtrack',
            'Ambient',
            'Chillout',
            'Trap',
            'Drill',
            'Grunge',
            'Opera',
            'Ska',
            'EDM',
            'World Music',
        ];

        foreach ($genres as $genre) {
            Genre::create(['name' => $genre]);
        }
    }
}
