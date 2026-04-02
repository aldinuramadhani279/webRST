<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_visits', function (Blueprint $table) {
            $table->id();
            $table->string('url', 500);
            $table->string('page_name', 200)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('session_id', 100)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('referer', 500)->nullable();
            $table->timestamps();

            $table->index('created_at');
            $table->index('url');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_visits');
    }
};
