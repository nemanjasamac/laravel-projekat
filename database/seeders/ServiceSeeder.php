<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        $images = [
            'services/service1.png',
            'services/service2.png',
            'services/service3.png',
            'services/service4.png',
            'services/service5.png',
        ];

        $services = [
            [
                'title' => 'Zastupanje u parničnim postupcima',
                'description' => 'Pružamo pravnu pomoć i zastupanje u svim vrstama parničnih postupaka.',
                'price' => 12000,
                'category_id' => $categories->random()->id,
                'is_featured' => true,
                'image' => $images[0],
            ],
            [
                'title' => 'Krivična odbrana',
                'description' => 'Odbrana u svim fazama krivičnog postupka pred svim sudovima.',
                'price' => 15000,
                'category_id' => $categories->random()->id,
                'is_featured' => true,
                'image' => $images[1],
            ],
            [
                'title' => 'Pravni saveti za nekretnine',
                'description' => 'Pravna provera i sastavljanje ugovora o kupoprodaji nekretnina.',
                'price' => 10000,
                'category_id' => $categories->random()->id,
                'is_featured' => false,
                'image' => $images[2],
            ],
            [
                'title' => 'Porodično pravo',
                'description' => 'Savetovanje i zastupanje u brakorazvodnim postupcima i pitanjima starateljstva.',
                'price' => 8000,
                'category_id' => $categories->random()->id,
                'is_featured' => true,
                'image' => $images[3],
            ],
            [
                'title' => 'Radno pravo',
                'description' => 'Zaštita prava zaposlenih i poslodavaca u radnim sporovima.',
                'price' => 9000,
                'category_id' => $categories->random()->id,
                'is_featured' => false,
                'image' => $images[4],
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
