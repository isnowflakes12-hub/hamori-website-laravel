<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('tempat_tidurs')) {
            Schema::create('tempat_tidurs', function (Blueprint $table) {
                $table->id();
                $table->string('kelas');
                $table->integer('total')->default(0);
                $table->integer('terisi')->default(0);
                $table->integer('tersedia')->default(0);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('tempat_tidurs');
    }
};
