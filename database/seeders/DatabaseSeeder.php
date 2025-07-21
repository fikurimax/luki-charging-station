<?php

namespace Database\Seeders;

use App\Models\Session;
use App\Models\Tables;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Tables::query()
                ->create([
                    'code' => "meja{$i}",
                    'name' => "Meja {$i}"
                ]);
        }

        Session::query()
            ->create([
                'name' => '3 Menit',
                'duration' => 3*60,
                'price' => 1500
            ]);

        Session::query()
            ->create([
                'name' => '10 Menit',
                'duration' => 10*60,
                'price' => 2000
            ]);

        Session::query()
            ->create([
                'name' => '20 Menit',
                'duration' => 20*60,
                'price' => 3000
            ]);

        Session::query()
            ->create([
                'name' => '30 Menit',
                'duration' => 30*60,
                'price' => 4000
            ]);
    }
}
