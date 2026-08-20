<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // PostgreSQL syntax
        DB::statement("ALTER TABLE karirs ALTER COLUMN kategori TYPE VARCHAR(255)");
        DB::statement("ALTER TABLE karirs ALTER COLUMN kategori SET DEFAULT 'Non Perawat'");
        
        DB::statement("ALTER TABLE karirs ALTER COLUMN tipe TYPE VARCHAR(255)");
        DB::statement("ALTER TABLE karirs ALTER COLUMN tipe SET DEFAULT 'full-time'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Down is not fully defined since enum types in postgres are complex, but we revert to varchar
        DB::statement("ALTER TABLE karirs ALTER COLUMN kategori TYPE VARCHAR(255)");
        DB::statement("ALTER TABLE karirs ALTER COLUMN tipe TYPE VARCHAR(255)");
    }
};
