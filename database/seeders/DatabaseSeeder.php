<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Roles menggunakan factory
        $roleAdmin = \App\Models\Role::factory()->admin()->create();
        $roleMahasiswa = \App\Models\Role::factory()->mahasiswa()->create();

        // Akun Admin Dummy menggunakan factory
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'username' => 'admin',
            'password' => Hash::make('Admin123'),
            'role_id' => $roleAdmin->id,
        ]);

        // Akun Mahasiswa Dummy menggunakan factory
        User::factory()->create([
            'name' => 'Mahasiswa Dummy',
            'email' => 'mahasiswa@example.com',
            'username' => 'mahasiswa',
            'password' => Hash::make('Mhs12345'),
            'role_id' => $roleMahasiswa->id,
        ]);

        // Generate 5 mahasiswa tambahan untuk testing
        User::factory(5)->create([
            'role_id' => $roleMahasiswa->id,
        ]);

        $this->call([
            EventSeeder::class,
            AnnouncementSeeder::class,
        ]);
    }
}
