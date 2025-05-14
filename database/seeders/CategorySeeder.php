<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Porodično pravo', 'description' => 'Razvodi, starateljstva, alimentacije.'],
            ['name' => 'Krivično pravo', 'description' => 'Odbrana u krivičnim predmetima.'],
            ['name' => 'Radno pravo', 'description' => 'Radni sporovi, otkazi, mobing.'],
            ['name' => 'Privredno pravo', 'description' => 'Pravne usluge za kompanije i preduzetnike.'],
            ['name' => 'Nekretnine', 'description' => 'Kupoprodaja, zakupi, ugovori o prometu nekretnina.'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
