<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artikel_kategori', function (Blueprint $table) {
            $table->unsignedBigInteger('artikel_id');
            $table->unsignedBigInteger('kategori_artikel_id');

            $table->primary(['artikel_id', 'kategori_artikel_id']);
            $table->foreign('artikel_id')->references('id')->on('artikels')->onDelete('cascade');
            $table->foreign('kategori_artikel_id')->references('id')->on('kategori_artikels')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artikel_kategori');
    }
};
