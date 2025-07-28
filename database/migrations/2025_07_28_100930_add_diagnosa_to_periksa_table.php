<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('periksa', function (Blueprint $table) {
        $table->text('diagnosa')->nullable()->after('keluhan');
    });
}

public function down(): void
{
    Schema::table('periksa', function (Blueprint $table) {
        $table->dropColumn('diagnosa');
    });
}

};
