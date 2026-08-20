<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('karir_kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('warna')->default('#0055a5');      // warna teks/aksen
            $table->string('warna_bg')->default('#eff6ff');   // warna background badge
            $table->string('icon')->default('bi-briefcase'); // Bootstrap Icons class
            $table->unsignedInteger('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('karir_kategoris'); }
};
