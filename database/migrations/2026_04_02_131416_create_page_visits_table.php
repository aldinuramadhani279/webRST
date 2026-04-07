<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Migration ini adalah duplikat yang sudah tidak digunakan.
     * Tabel page_visits sudah dibuat oleh migration 2026_04_02_000001.
     * Dibiarkan kosong agar tidak mengganggu proses migrate.
     */
    public function up(): void
    {
        // Skip: tabel page_visits sudah dibuat oleh migration sebelumnya
        if (!Schema::hasTable('page_visits')) {
            Schema::create('page_visits', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        // Tidak ada aksi rollback untuk migration duplikat ini
    }
};
