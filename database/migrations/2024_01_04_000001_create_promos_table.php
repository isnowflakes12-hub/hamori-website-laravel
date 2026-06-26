<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::dropIfExists('promos');
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 150);
            $table->string('gambar')->nullable();
            $table->string('deskripsi', 300)->nullable();
            $table->text('detail')->nullable();          // max 1000 char, typewriter
            $table->json('benefit')->nullable();
            $table->date('berlaku_mulai')->nullable();
            $table->date('berlaku_sampai')->nullable();          // text list
            $table->string('link_cta')->nullable();       // link aksi
            $table->boolean('is_featured')->default(false); // max 3
            if (!Schema::hasColumn('promos', 'urutan')) {
            $table->integer('urutan')->default(0);
            }
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('promos'); }
};
