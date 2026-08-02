<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasIndex('kos', 'idx_kos_pemilik_status')) {
            Schema::table('kos', fn(Blueprint $t) => $t->index(['id_pemilik', 'status_kos'], 'idx_kos_pemilik_status'));
        }

        if (!Schema::hasIndex('kamar', 'idx_kamar_kos_status')) {
            Schema::table('kamar', fn(Blueprint $t) => $t->index(['id_kos', 'status_kamar'], 'idx_kamar_kos_status'));
        }

        if (!Schema::hasIndex('kontrak_sewa', 'idx_kontrak_penghuni_status')) {
            Schema::table('kontrak_sewa', fn(Blueprint $t) => $t->index(['id_penghuni', 'status_kontrak'], 'idx_kontrak_penghuni_status'));
        }

        if (!Schema::hasIndex('kontrak_sewa', 'idx_kontrak_kos_status')) {
            Schema::table('kontrak_sewa', fn(Blueprint $t) => $t->index(['id_kos', 'status_kontrak'], 'idx_kontrak_kos_status'));
        }

        if (!Schema::hasIndex('kontrak_sewa', 'idx_kontrak_kamar')) {
            Schema::table('kontrak_sewa', fn(Blueprint $t) => $t->index(['id_kamar'], 'idx_kontrak_kamar'));
        }

        if (!Schema::hasIndex('pembayaran', 'idx_pembayaran_penghuni_status')) {
            Schema::table('pembayaran', fn(Blueprint $t) => $t->index(['id_penghuni', 'status_pembayaran'], 'idx_pembayaran_penghuni_status'));
        }

        if (!Schema::hasIndex('pembayaran', 'idx_pembayaran_kontrak_status')) {
            Schema::table('pembayaran', fn(Blueprint $t) => $t->index(['id_kontrak', 'status_pembayaran'], 'idx_pembayaran_kontrak_status'));
        }

        if (!Schema::hasIndex('pembayaran', 'idx_pembayaran_tanggal')) {
            Schema::table('pembayaran', fn(Blueprint $t) => $t->index(['tanggal_bayar'], 'idx_pembayaran_tanggal'));
        }

        if (!Schema::hasIndex('pembayaran', 'idx_pembayaran_bulan')) {
            Schema::table('pembayaran', fn(Blueprint $t) => $t->index(['bulan_tahun'], 'idx_pembayaran_bulan'));
        }

        if (!Schema::hasIndex('pembayaran', 'idx_pembayaran_jatuh_tempo')) {
            Schema::table('pembayaran', fn(Blueprint $t) => $t->index(['tanggal_jatuh_tempo'], 'idx_pembayaran_jatuh_tempo'));
        }

        if (!Schema::hasIndex('reviews', 'idx_reviews_kos')) {
            Schema::table('reviews', fn(Blueprint $t) => $t->index(['id_kos'], 'idx_reviews_kos'));
        }

        if (Schema::hasTable('foto_kos') && !Schema::hasIndex('foto_kos', 'idx_foto_kos')) {
            Schema::table('foto_kos', fn(Blueprint $t) => $t->index(['id_kos'], 'idx_foto_kos'));
        }

        if (Schema::hasTable('pengaturan_kos') && !Schema::hasIndex('pengaturan_kos', 'idx_pengaturan_kos')) {
            Schema::table('pengaturan_kos', fn(Blueprint $t) => $t->index(['id_kos'], 'idx_pengaturan_kos'));
        }

        if (!Schema::hasIndex('kos_fasilitas', 'idx_kos_fasilitas')) {
            Schema::table('kos_fasilitas', fn(Blueprint $t) => $t->index(['id_kos'], 'idx_kos_fasilitas'));
        }

        if (!Schema::hasIndex('pemilik', 'idx_pemilik_user')) {
            Schema::table('pemilik', fn(Blueprint $t) => $t->index(['user_id'], 'idx_pemilik_user'));
        }

        if (!Schema::hasIndex('penghuni', 'idx_penghuni_user')) {
            Schema::table('penghuni', fn(Blueprint $t) => $t->index(['user_id'], 'idx_penghuni_user'));
        }
    }

    public function down(): void
    {
        Schema::table('kos', fn(Blueprint $t) => $t->dropIndex('idx_kos_pemilik_status'));
        Schema::table('kamar', fn(Blueprint $t) => $t->dropIndex('idx_kamar_kos_status'));
        Schema::table('kontrak_sewa', function (Blueprint $t) {
            $t->dropIndex('idx_kontrak_penghuni_status');
            $t->dropIndex('idx_kontrak_kos_status');
            $t->dropIndex('idx_kontrak_kamar');
        });
        Schema::table('pembayaran', function (Blueprint $t) {
            $t->dropIndex('idx_pembayaran_penghuni_status');
            $t->dropIndex('idx_pembayaran_kontrak_status');
            $t->dropIndex('idx_pembayaran_tanggal');
            $t->dropIndex('idx_pembayaran_bulan');
            $t->dropIndex('idx_pembayaran_jatuh_tempo');
        });
        Schema::table('reviews', fn(Blueprint $t) => $t->dropIndex('idx_reviews_kos'));
        if (Schema::hasTable('foto_kos')) {
            Schema::table('foto_kos', fn(Blueprint $t) => $t->dropIndex('idx_foto_kos'));
        }
        if (Schema::hasTable('pengaturan_kos')) {
            Schema::table('pengaturan_kos', fn(Blueprint $t) => $t->dropIndex('idx_pengaturan_kos'));
        }
        Schema::table('kos_fasilitas', fn(Blueprint $t) => $t->dropIndex('idx_kos_fasilitas'));
        Schema::table('pemilik', fn(Blueprint $t) => $t->dropIndex('idx_pemilik_user'));
        Schema::table('penghuni', fn(Blueprint $t) => $t->dropIndex('idx_penghuni_user'));
    }
};
