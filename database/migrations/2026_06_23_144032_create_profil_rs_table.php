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
        Schema::create('profil_rs', function (Blueprint $table) {
            $table->id();
            $table->text('deskripsi')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->string('kars_logo')->nullable();
            $table->string('gambar_utama')->nullable();
            $table->string('total_dokter')->default('32+');
            $table->string('total_bed')->default('100+');
            $table->string('pusat_unggulan')->default('10+');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_rs');
    }
};
