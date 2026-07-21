<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (config('database.default') !== 'sqlite') {
            DB::statement("ALTER TABLE penghuni MODIFY COLUMN status_penghuni ENUM('calon','aktif','nonaktif','ditolak','dibatasi','diblokir') DEFAULT 'calon'");
        }
    }

    public function down(): void
    {
        if (config('database.default') !== 'sqlite') {
            DB::statement("ALTER TABLE penghuni MODIFY COLUMN status_penghuni ENUM('calon','aktif','nonaktif','ditolak') DEFAULT 'calon'");
        }
    }
};
