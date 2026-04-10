<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('kategori_artikels', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->after('slug');
            $table->string('warna', 20)->default('#0055a5')->after('deskripsi');
            $table->integer('urutan')->default(0)->after('warna');
            $table->boolean('is_active')->default(true)->after('urutan');
        });
    }
    public function down(): void {
        Schema::table('kategori_artikels', function (Blueprint $table) {
            $table->dropColumn(['deskripsi','warna','urutan','is_active']);
        });
    }
};
