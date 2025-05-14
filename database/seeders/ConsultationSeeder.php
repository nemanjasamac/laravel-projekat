<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Consultation;
use App\Models\User;
use App\Models\Service;
use Carbon\Carbon;

class ConsultationSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $services = Service::all();
        
        foreach (range(1, 2) as $index) {
            $date = Carbon::now()->subDays(rand(1, 10));
            
            Consultation::create([
                'user_id' => $users->random()->id,
                'service_id' => $services->random()->id,
                'date' => $date->toDateString(),
                'time' => $date->format('H:i:s'),
                'status' => 'zavrseno',
                'notes' => 'Završena konsultacija ' . $index,
            ]);
        }
        
        foreach (range(1, 2) as $index) {
            $date = Carbon::now()->addDays(rand(1, 15));
            
            Consultation::create([
                'user_id' => $users->random()->id,
                'service_id' => $services->random()->id,
                'date' => $date->toDateString(),
                'time' => $date->format('H:i:s'),
                'status' => 'zakazano',
                'notes' => 'Zakazana konsultacija ' . $index,
            ]);
        }
        
        $date = Carbon::now()->addDays(rand(5, 20));
        
        Consultation::create([
            'user_id' => $users->random()->id,
            'service_id' => $services->random()->id,
            'date' => $date->toDateString(),
            'time' => $date->format('H:i:s'),
            'status' => 'otkazano',
            'notes' => 'Otkazana konsultacija',
        ]);
    }
}
