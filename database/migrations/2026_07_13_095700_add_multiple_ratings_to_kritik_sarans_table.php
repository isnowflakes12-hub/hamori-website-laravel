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
            $table->dropColumn('rating');
            $table->tinyInteger('rating_kepuasan_rs')->nullable()->after('kategori');
            $table->tinyInteger('rating_alur_pelayanan')->nullable()->after('rating_kepuasan_rs');
            $table->tinyInteger('rating_fasilitas')->nullable()->after('rating_alur_pelayanan');
            $table->tinyInteger('rating_kesesuaian_biaya')->nullable()->after('rating_fasilitas');
            $table->tinyInteger('rating_pelayanan_dokter')->nullable()->after('rating_kesesuaian_biaya');
            $table->tinyInteger('rating_pelayanan_perawat')->nullable()->after('rating_pelayanan_dokter');
            $table->tinyInteger('rating_pelayanan_penunjang')->nullable()->after('rating_pelayanan_perawat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kritik_sarans', function (Blueprint $table) {
            $table->dropColumn([
                'rating_kepuasan_rs',
                'rating_alur_pelayanan',
                'rating_fasilitas',
                'rating_kesesuaian_biaya',
                'rating_pelayanan_dokter',
                'rating_pelayanan_perawat',
                'rating_pelayanan_penunjang'
            ]);
            $table->tinyInteger('rating')->nullable()->after('pesan');
        });
    }
};
