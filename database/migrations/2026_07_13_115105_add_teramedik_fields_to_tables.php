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
        Schema::table('polis', function (Blueprint $table) {
            $table->string('teramedik_id')->nullable()->after('id')->index();
        });

        Schema::table('dokters', function (Blueprint $table) {
            $table->string('teramedik_id')->nullable()->after('id')->index();
        });

        Schema::table('jadwal_dokters', function (Blueprint $table) {
            $table->string('teramedik_dsid')->nullable()->after('id')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('polis', function (Blueprint $table) {
            $table->dropColumn('teramedik_id');
        });

        Schema::table('dokters', function (Blueprint $table) {
            $table->dropColumn('teramedik_id');
        });

        Schema::table('jadwal_dokters', function (Blueprint $table) {
            $table->dropColumn('teramedik_dsid');
        });
    }
};
