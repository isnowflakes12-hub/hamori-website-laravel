<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('lamaran_karirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karir_id')->constrained('karirs')->onDelete('cascade');
            $table->string('nama');
            $table->string('email');
            $table->string('telepon');
            $table->string('cv'); // file path
            $table->text('cover_letter')->nullable();
            $table->enum('status', ['pending','review','shortlist','interview','diterima','ditolak'])->default('pending');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('lamaran_karirs'); }
};