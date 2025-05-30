<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointment_statuses', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('appointmentStatusName');
        });

        DB::table('appointment_statuses')->insert([
            ['id'=>1, 'appointmentStatusName'=>'wolna'],
            ['id'=>2, 'appointmentStatusName'=>'zaplanowana'],
            ['id'=>3, 'appointmentStatusName'=>'anulowana'],
            ['id'=>4, 'appointmentStatusName'=>'zrealizowana'],
            ['id'=>5, 'appointmentStatusName'=>'nieobecność'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_statuses');
    }
};
