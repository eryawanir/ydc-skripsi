<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('periksa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')
                ->constrained('patients')
                ->onDelete('restrict');

            $table->foreignId('dokter_id')
                ->constrained('dokters')
                ->onDelete('restrict');

            $table->text('keluhan');
            $table->dateTime('waktu_kedatangan');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('periksa');
    }
};
