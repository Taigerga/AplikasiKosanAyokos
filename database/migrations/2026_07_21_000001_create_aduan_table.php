<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aduan', function (Blueprint $table) {
            $table->bigIncrements('id_aduan');
            $table->unsignedBigInteger('id_pengirim');
            $table->string('pengirim_role', 20);
            $table->string('judul', 255);
            $table->string('kategori', 100);
            $table->text('deskripsi');
            $table->string('lampiran', 255)->nullable();
            $table->enum('status_aduan', ['diajukan', 'ditinjau', 'diproses', 'menunggu_info', 'selesai', 'ditolak', 'ditutup'])->default('diajukan');
            $table->timestamps();

            $table->foreign('id_pengirim')->references('id')->on('users')->onDelete('cascade');
            $table->index('id_pengirim');
            $table->index('status_aduan');
            $table->index('kategori');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aduan');
    }
};
