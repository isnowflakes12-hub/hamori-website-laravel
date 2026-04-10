<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasColumn('lamaran_karirs', 'status')) {
            Schema::table('lamaran_karirs', function (Blueprint $table) {
                $table->enum('status', [
                    'pending',
                    'review',
                    'shortlist',
                    'interview',
                    'diterima',
                    'ditolak'
                ])->default('pending')->after('cover_letter');
            });
        }
    }
};
