<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->bigIncrements('id_pembayaran');
            $table->foreignId('id_kontrak')->constrained('kontrak_sewa', 'id_kontrak')->onDelete('cascade');
            $table->foreignId('id_penghuni')->constrained('penghuni', 'id_penghuni')->onDelete('cascade');
            $table->string('bulan_tahun', 7);
            $table->date('tanggal_mulai_sewa')->nullable();
            $table->date('tanggal_akhir_sewa')->nullable();
            $table->date('tanggal_jatuh_tempo');
            $table->date('tanggal_bayar')->nullable();
            $table->decimal('jumlah', 12, 2);
            $table->decimal('denda', 12, 2)->default(0.00);
            $table->decimal('total_bayar', 12, 2)->nullable();
            $table->string('bukti_pembayaran', 255)->nullable();
            $table->enum('metode_pembayaran', ['transfer', 'cash', 'qris'])->default('transfer');
            $table->enum('status_pembayaran', ['belum', 'lunas', 'terlambat', 'pending'])->default('belum');
            $table->string('jenis_pembayaran', 50)->default('rutin');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
