<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('kritik_sarans', function (Blueprint $table) {
            $table->enum('responden', ['pasien', 'pengunjung'])->nullable()->after('kategori');
            $table->string('nama_poliklinik')->nullable()->after('responden');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kritik_sarans', function (Blueprint $table) {
            $table->dropColumn(['responden', 'nama_poliklinik']);
        });
    }
};
