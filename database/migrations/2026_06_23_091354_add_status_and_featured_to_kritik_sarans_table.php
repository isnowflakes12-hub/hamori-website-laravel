<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('kritik_sarans', function (Blueprint $table) {
            $table->string('status')->default('pending')->after('is_read');
            $table->boolean('is_featured')->default(false)->after('status');
            $table->timestamp('approved_at')->nullable()->after('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kritik_sarans', function (Blueprint $table) {
            $table->dropColumn(['status', 'is_featured', 'approved_at']);
        });
    }
};
