<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kos_fasilitas', function (Blueprint $table) {
            $table->bigIncrements('id_kos_fasilitas');
            $table->foreignId('id_kos')->constrained('kos', 'id_kos')->onDelete('cascade');
            $table->foreignId('id_fasilitas')->constrained('fasilitas', 'id_fasilitas')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['id_kos', 'id_fasilitas']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kos_fasilitas');
    }
};
