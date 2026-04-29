<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Drop notif_* columns from kontrak_sewa table if they exist
        if (Schema::hasTable('kontrak_sewa')) {
            Schema::table('kontrak_sewa', function (Blueprint $table) {
                $columnsToDrop = [];
                
                $possibleColumns = [
                    'notif_menunggu_dikirim',
                    'notif_disetujui_dikirim',
                    'notif_tolak_dikirim',
                    'notif_5hari_dikirim',
                    'notif_habis_dikirim',
                    'notif_7hari_dikirim',
                    'notif_3hari_dikirim',
                    'notif_h1_dikirim',
                    'notif_hari_ini_dikirim',
                    'notif_terlambat_dikirim',
                    'notif_perpanjangan_dikirim'
                ];
                
                foreach ($possibleColumns as $column) {
                    if (Schema::hasColumn('kontrak_sewa', $column)) {
                        $columnsToDrop[] = $column;
                    }
                }
                
                if (!empty($columnsToDrop)) {
                    $table->dropColumn($columnsToDrop);
                }
            });
        }

        // Drop notif_pengajuan_baru_dikirim from pemilik table if exists
        if (Schema::hasTable('pemilik') && Schema::hasColumn('pemilik', 'notif_pengajuan_baru_dikirim')) {
            Schema::table('pemilik', function (Blueprint $table) {
                $table->dropColumn('notif_pengajuan_baru_dikirim');
            });
        }
    }

    public function down()
    {
        // Restore notif_* columns to kontrak_sewa table
        Schema::table('kontrak_sewa', function (Blueprint $table) {
            $table->timestamp('notif_menunggu_dikirim')->nullable();
            $table->timestamp('notif_disetujui_dikirim')->nullable();
            $table->timestamp('notif_tolak_dikirim')->nullable();
            $table->timestamp('notif_5hari_dikirim')->nullable();
            $table->timestamp('notif_habis_dikirim')->nullable();
            $table->timestamp('notif_7hari_dikirim')->nullable();
            $table->timestamp('notif_3hari_dikirim')->nullable();
            $table->timestamp('notif_h1_dikirim')->nullable();
            $table->timestamp('notif_hari_ini_dikirim')->nullable();
            $table->timestamp('notif_terlambat_dikirim')->nullable();
            $table->timestamp('notif_perpanjangan_dikirim')->nullable();
        });

        // Restore notif_pengajuan_baru_dikirim to pemilik table
        Schema::table('pemilik', function (Blueprint $table) {
            $table->timestamp('notif_pengajuan_baru_dikirim')->nullable();
        });
    }
};
