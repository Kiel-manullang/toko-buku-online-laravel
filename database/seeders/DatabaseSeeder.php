<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Penting: Pastikan ini ada
use App\Models\User; // Penting: Pastikan ini ada

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Panggil seeder lain jika ada, contoh:
        // $this->call([
        //     KategoriSeeder::class,
        //     BukuSeeder::class,
        // ]);

        // Buat akun admin default jika belum ada
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Admin Utama',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'), // Password default: 'password'
                'role' => 'admin', // Pastikan kolom 'role' ada di tabel 'users'
            ]);
            $this->command->info('Akun admin default berhasil dibuat: admin@example.com / password');
        } else {
            $this->command->info('Akun admin default sudah ada.');
        }

        // Contoh membuat user biasa jika belum ada
        if (!User::where('email', 'user@example.com')->exists()) {
            User::create([
                'name' => 'Pengguna Biasa',
                'email' => 'user@example.com',
                'password' => Hash::make('password'), // Password default: 'password'
                'role' => 'user', // Pastikan kolom 'role' ada di tabel 'users'
            ]);
            $this->command->info('Akun pengguna biasa default berhasil dibuat: user@example.com / password');
        } else {
            $this->command->info('Akun pengguna biasa default sudah ada.');
        }
    }
}