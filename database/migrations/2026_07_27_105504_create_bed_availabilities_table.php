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
        Schema::create('bed_availabilities', function (Blueprint $table) {
            $table->id();
            $table->string('kelas'); // e.g. VVIP, VIP, Kelas I
            $table->string('nama_ruangan')->nullable(); // e.g. Paviliun Anggrek
            $table->integer('kapasitas')->default(0);
            $table->integer('terisi')->default(0);
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bed_availabilities');
    }
};
