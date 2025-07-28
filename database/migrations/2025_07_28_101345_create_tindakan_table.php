<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('tindakan', function (Blueprint $table) {
        $table->id();
        $table->foreignId('periksa_id')->constrained('periksa')->onDelete('cascade');
        $table->foreignId('layanan_id')->constrained('layanan')->onDelete('restrict');
        $table->string('lokasi')->nullable();
        $table->decimal('uang_masuk', 10, 2)->default(0);
        $table->decimal('fee_dokter', 10, 2)->default(0);
        $table->decimal('pendapatan_klinik', 10, 2)->default(0);
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('tindakan');
}

};
