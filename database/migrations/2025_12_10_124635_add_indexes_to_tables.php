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
        // Add indexes to improve query performance
        Schema::table('doctors', function (Blueprint $table) {
            $table->index('specialization_id');
            $table->index('is_active');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->index('category');
            $table->index('slug');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->index('status');
            $table->index('published_at');
        });

        Schema::table('specializations', function (Blueprint $table) {
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropIndex(['specialization_id']);
            $table->dropIndex(['is_active']);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropIndex(['category']);
            $table->dropIndex(['slug']);
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['published_at']);
        });

        Schema::table('specializations', function (Blueprint $table) {
            $table->dropIndex(['name']);
        });
    }
};
