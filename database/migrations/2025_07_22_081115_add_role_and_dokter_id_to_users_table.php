<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedTinyInteger('role')->after('password'); // 1 = admin, 2 = manajemen, 3 = dokter
            $table->foreignId('dokter_id')->nullable()->after('role')->constrained('dokters')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['dokter_id']);
            $table->dropColumn(['role', 'dokter_id']);
        });
    }
};
