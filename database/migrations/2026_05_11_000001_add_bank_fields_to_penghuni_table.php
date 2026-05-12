<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penghuni', function (Blueprint $table) {
            $table->string('nama_bank', 50)->nullable()->after('foto_profil');
            $table->string('nomor_rekening', 50)->nullable()->after('nama_bank');
        });
    }

    public function down(): void
    {
        Schema::table('penghuni', function (Blueprint $table) {
            $table->dropColumn(['nama_bank', 'nomor_rekening']);
        });
    }
};
