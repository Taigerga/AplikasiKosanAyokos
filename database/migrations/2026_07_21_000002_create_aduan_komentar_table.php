<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aduan_komentar', function (Blueprint $table) {
            $table->bigIncrements('id_komentar');
            $table->unsignedBigInteger('id_aduan');
            $table->unsignedBigInteger('id_pengirim');
            $table->text('isi');
            $table->string('lampiran', 255)->nullable();
            $table->timestamps();

            $table->foreign('id_aduan')->references('id_aduan')->on('aduan')->onDelete('cascade');
            $table->foreign('id_pengirim')->references('id')->on('users')->onDelete('cascade');
            $table->index('id_aduan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aduan_komentar');
    }
};
