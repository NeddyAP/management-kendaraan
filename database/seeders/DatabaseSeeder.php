<?php

namespace Database\Seeders;

use App\Models\Kendaraan;
use App\Models\Maintenance;
use App\Models\MtGroup;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
        ]);

        // $path = storage_path('app/public/tbl_kendaraan.sql');
        // DB::unprepared(file_get_contents($path));
        Kendaraan::factory()
        ->count(100)
        ->has(
            MtGroup::factory()
                ->has(Maintenance::factory()->count(rand(1, 5)))
        )
        ->create();
    }
}
