<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\AppointmentStatusSeeder;
use Database\Seeders\MedicineSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AppointmentStatusSeeder::class,
            MedicineSeeder::class
        ]);
    }
}
