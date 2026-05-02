<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kontrak_sewa', function (Blueprint $table) {
            $table->bigIncrements('id_kontrak');
            $table->foreignId('id_penghuni')->constrained('penghuni', 'id_penghuni')->onDelete('cascade');
            $table->foreignId('id_kos')->constrained('kos', 'id_kos')->onDelete('cascade');
            $table->foreignId('id_kamar')->constrained('kamar', 'id_kamar')->onDelete('cascade');
            $table->string('foto_ktp', 255)->nullable();
            $table->date('tanggal_daftar');
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->integer('durasi_sewa')->default(1);
            $table->decimal('harga_sewa', 12, 2);
            $table->enum('status_kontrak', ['pending', 'aktif', 'selesai', 'ditolak'])->default('pending');
            $table->text('alasan_ditolak')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kontrak_sewa');
    }
};
