<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dokters', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // wajib
            $table->enum('jenis_kelamin', ['L', 'P']); // wajib
            $table->string('no_sertifikat'); // wajib
            $table->string('tempat_lahir')->nullable(); // boleh null
            $table->date('tanggal_lahir')->nullable(); // boleh null
            $table->string('no_hp'); // wajib
            $table->string('nik')->unique()->nullable(); // boleh null
            $table->text('alamat')->nullable(); // boleh null
            $table->unsignedTinyInteger('tipe_dokter'); // wajib (1 = SIP, 2 = Non-SIP)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokters');
    }
};
