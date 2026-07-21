<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $driver = config('database.default');
        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE pemilik MODIFY COLUMN status_pemilik ENUM('aktif','nonaktif','pending','dibatasi','diblokir') DEFAULT 'pending'");
        } elseif ($driver === 'sqlite') {
            DB::statement("PRAGMA ignore_check_constraints = ON");
        }
    }

    public function down(): void
    {
        $driver = config('database.default');
        if ($driver === 'mysql') {
            DB::statement("ALTER TABLE pemilik MODIFY COLUMN status_pemilik ENUM('aktif','nonaktif','pending') DEFAULT 'pending'");
        } elseif ($driver === 'sqlite') {
            DB::statement("PRAGMA ignore_check_constraints = OFF");
        }
    }
};
