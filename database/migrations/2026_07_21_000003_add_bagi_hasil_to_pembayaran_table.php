<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->decimal('bagian_pemilik', 12, 2)->nullable()->after('total_bayar');
            $table->decimal('bagian_platform', 12, 2)->nullable()->after('bagian_pemilik');
        });
    }

    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropColumn(['bagian_pemilik', 'bagian_platform']);
        });
    }
};
