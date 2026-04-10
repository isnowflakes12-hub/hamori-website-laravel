<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->foreignId('kategori_id')->nullable()->constrained('kategori_artikels')->nullOnDelete();
            $table->foreignId('dokter_id')->nullable()->constrained()->nullOnDelete();
            $table->string('thumbnail')->nullable();
            $table->text('ringkasan')->nullable();
            $table->longText('konten')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('artikels'); }
};
