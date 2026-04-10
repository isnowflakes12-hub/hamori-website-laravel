<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('logo')->nullable();
            $table->string('kategori')->default('Asuransi');
            $table->string('website')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->text('pertanyaan');
            $table->longText('jawaban');
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        Schema::create('tempat_tidurs', function (Blueprint $table) {
            $table->id();
            $table->string('kelas');
            $table->integer('total')->default(0);
            $table->integer('terisi')->default(0);
            $table->integer('tersedia')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('partners');
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('tempat_tidurs');
    }
};
