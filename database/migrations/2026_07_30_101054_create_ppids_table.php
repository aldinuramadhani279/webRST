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
    Schema::create('ppids', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('category'); // e.g. 'sk', 'struktur', 'maklumat', etc.
        $table->text('description')->nullable();
        $table->string('file')->nullable(); // uploaded PDF/doc
        $table->timestamps();
    });
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppids');
    }
};
