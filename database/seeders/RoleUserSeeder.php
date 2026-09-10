<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * * Buat akun percobaan untuk Admin & Owner, supaya role
     * middleware & redirect bisa langsung dites tanpa perlu
     * ubah data manual lewat database.
     *
     * Password default: "password" — WAJIB diganti sebelum
     * production, ini hanya untuk kebutuhan development.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@rentalmotor.test'],
            [
                'name' => 'Admin Rental',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'owner@rentalmotor.test'],
            [
                'name' => 'Owner Rental',
                'password' => bcrypt('password'),
                'role' => 'owner',
                'email_verified_at' => now(),
            ]
        );
    }
}
