<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AppointmentStatus;

class AppointmentStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['id' => 1, 'appointmentStatusName' => 'wolna'],
            ['id' => 2, 'appointmentStatusName' => 'zaplanowana'],
            ['id' => 3, 'appointmentStatusName' => 'anulowana'],
            ['id' => 4, 'appointmentStatusName' => 'zrealizowana'],
            ['id' => 5, 'appointmentStatusName' => 'nieobecność'],
        ];

        foreach ($statuses as $status) {
            AppointmentStatus::updateOrCreate(['id' => $status['id']], $status);
        }
    }
}
