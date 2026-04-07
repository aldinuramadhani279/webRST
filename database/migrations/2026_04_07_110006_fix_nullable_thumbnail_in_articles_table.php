<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Menjadikan kolom thumbnail nullable agar artikel bisa disimpan tanpa thumbnail.
     */
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('thumbnail')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('thumbnail')->nullable(false)->change();
        });
    }
};
