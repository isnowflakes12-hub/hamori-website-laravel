<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('karirs', function (Blueprint $table) {
            $table->id();
            $table->string('posisi');
            $table->string('departemen');
            $table->enum('kategori', ['Perawat', 'Penunjang Medis', 'Pelayanan Medis', 'Non Perawat'])->default('Non Perawat');
            $table->enum('tipe', ['full-time','part-time','kontrak','magang'])->default('full-time');
            $table->string('lokasi')->nullable();
            $table->unsignedInteger('kuota')->default(1);
            $table->longText('deskripsi');
            $table->longText('persyaratan');
            $table->date('batas_lamaran')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('karirs'); }
};
