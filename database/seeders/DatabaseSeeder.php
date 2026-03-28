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
     * 
     * ⚠️ PERHATIAN: Gunakan:
     * - php artisan migrate         → Jalankan migration (data AMAN)
     * - php artisan db:seed         → Isi data seeder (data AMAN)
     * - php artisan migrate:fresh   → HAPUS semua data! (hati-hati!)
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin1',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(), // ✅ Email verified
        ]);
    }
}
