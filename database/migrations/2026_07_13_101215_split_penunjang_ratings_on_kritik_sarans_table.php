<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kritik_sarans', function (Blueprint $table) {
            $table->dropColumn('rating_pelayanan_penunjang');
            $table->tinyInteger('rating_laboratorium')->nullable()->after('rating_pelayanan_perawat');
            $table->tinyInteger('rating_radiologi')->nullable()->after('rating_laboratorium');
            $table->tinyInteger('rating_fisioterapi')->nullable()->after('rating_radiologi');
            $table->tinyInteger('rating_farmasi')->nullable()->after('rating_fisioterapi');
        });
    }

    public function down(): void
    {
        Schema::table('kritik_sarans', function (Blueprint $table) {
            $table->dropColumn(['rating_laboratorium', 'rating_radiologi', 'rating_fisioterapi', 'rating_farmasi']);
            $table->tinyInteger('rating_pelayanan_penunjang')->nullable()->after('rating_pelayanan_perawat');
        });
    }
};
