<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('kontaks', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('telepon')->nullable();
            $table->string('subjek');
            $table->text('pesan');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
        Schema::create('kritik_sarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->enum('kategori', ['kritik','saran','pertanyaan']);
            $table->text('pesan');
            $table->tinyInteger('rating')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('kontaks');
        Schema::dropIfExists('kritik_sarans');
    }
};
