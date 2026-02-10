<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create jabatan data
        $this->call(\Database\Seeders\JabatanSeeder::class);

        // Create profil pegawai data
        $this->call(\Database\Seeders\ProfilPegawaiSeeder::class);

        // Create admin user for accessing admin panel
        $this->call(\Database\Seeders\AdminUserSeeder::class);
    }
}
