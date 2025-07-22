<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Dokter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil dokter pertama untuk user role dokter
        $dokters = Dokter::all();

        // Admin
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin YDC',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'role' => 1, // Admin
                'dokter_id' => null,
            ]
        );

        // Manajemen
        User::firstOrCreate(
            ['email' => 'manajemen@gmail.com'],
            [
                'name' => 'Manajemen YDC',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'role' => 2, // Manajemen
                'dokter_id' => null,
            ]
        );

        // Dokter
        if ($dokters) {
            User::firstOrCreate(
                ['email' => 'drg.yustika@gmail.com'],
                [
                    'name' => $dokters[0]->nama,
                    'email_verified_at' => now(),
                    'password' => Hash::make('password'),
                    'remember_token' => Str::random(10),
                    'role' => 3, // Dokter
                    'dokter_id' => $dokters[0]->id,
                ]
            );
            User::firstOrCreate(
                ['email' => 'drg.nabela@gmail.com'],
                [
                    'name' => $dokters[1]->nama,
                    'email_verified_at' => now(),
                    'password' => Hash::make('password'),
                    'remember_token' => Str::random(10),
                    'role' => 3, // Dokter
                    'dokter_id' => $dokters[1]->id,
                ]
            );
        }
    }
}
