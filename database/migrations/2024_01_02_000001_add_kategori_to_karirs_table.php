<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasColumn('karirs', 'kategori')) {
            Schema::table('karirs', function (Blueprint $table) {
                $table->enum('kategori', [
                    'Perawat',
                    'Penunjang Medis',
                    'Pelayanan Medis',
                    'Non Perawat'
                ])->default('Non Perawat')->after('departemen');
            });
        }
    }
};
