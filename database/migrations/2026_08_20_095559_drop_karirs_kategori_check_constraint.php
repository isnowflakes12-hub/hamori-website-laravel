<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE karirs DROP CONSTRAINT IF EXISTS karirs_kategori_check');
            DB::statement('ALTER TABLE karirs DROP CONSTRAINT IF EXISTS karirs_tipe_check');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not easily reversible since the original check constraints were enum definitions
    }
};
