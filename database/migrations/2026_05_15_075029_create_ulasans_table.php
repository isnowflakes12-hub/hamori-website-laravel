<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ulasans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->nullable();
            $table->string('no_hp')->nullable();
            $table->tinyInteger('rating')->default(5)->comment('1-5 bintang');
            $table->string('kategori')->default('umum')->comment('umum|rawat_inap|rawat_jalan|igd|mcu');
            $table->text('ulasan');
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->string('avatar_color', 20)->nullable()->comment('hex warna avatar otomatis');
            $table->string('sumber')->default('website')->comment('website|whatsapp|manual');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['is_approved', 'is_featured']);
            $table->index(['rating', 'is_approved']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ulasans');
    }
};