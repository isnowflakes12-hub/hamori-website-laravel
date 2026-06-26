<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('promos', function (Blueprint $table) {
            $table->text('syarat_ketentuan')->nullable()->after('detail');
            $table->json('cara_mendapatkan')->nullable()->after('syarat_ketentuan');
            $table->boolean('terima_bpjs')->default(false)->after('cara_mendapatkan');
            $table->boolean('is_home_featured')->default(false)->after('is_featured');
        });
    }

    public function down(): void
    {
        Schema::table('promos', function (Blueprint $table) {
            $table->dropColumn(['syarat_ketentuan', 'cara_mendapatkan', 'terima_bpjs', 'is_home_featured']);
        });
    }
};
