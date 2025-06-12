<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Lekarz
        $doctorUser = User::create([
            'email' => 'jklima.lekarz@yourcure.com',
            'password' => Hash::make('JolantaKlimaLekarz2025!'),
            'role' => 'doctor',
            'firstName' => 'Jolanta',
            'lastName' => 'Klima',
        ]);

        Doctor::create([
            'user_id' => $doctorUser->id,
            'specialization' => 'Programista',
            'license_number' => 'JK123456',
        ]);

        // Pacjent
        $patientUser = User::create([
            'email' => 'jklima.pacjent@yourcure.com',
            'password' => Hash::make('JolantaKlimaPacjent2025!'),
            'role' => 'patient',
            'firstName' => 'Jolanta',
            'lastName' => 'Klima',
        ]);

        Patient::create([
            'user_id' => $patientUser->id,
            'pesel' => '90010112345',
            'birth_date' => '1990-01-01',
        ]);

        // Admin
        User::create([
            'email' => 'jklima.admin@yourcure.com',
            'password' => Hash::make('JolantaKlimaAdmin2025!'),
            'role' => 'admin',
            'firstName' => 'Jolanta',
            'lastName' => 'Klima',
        ]);
    }
}

