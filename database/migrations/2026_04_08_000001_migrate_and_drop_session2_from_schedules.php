<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Step 1: Migrate existing session 2 data to separate records
        if (Schema::hasColumn('schedules', 'start_time_2')) {
            $rows = DB::table('schedules')
                ->whereNotNull('start_time_2')
                ->whereNotNull('end_time_2')
                ->get();

            foreach ($rows as $row) {
                // Check if a duplicate already exists to avoid collision
                $exists = DB::table('schedules')
                    ->where('doctor_id', $row->doctor_id)
                    ->where('day', $row->day)
                    ->where('start_time', $row->start_time_2)
                    ->where('end_time', $row->end_time_2)
                    ->exists();

                if (!$exists) {
                    DB::table('schedules')->insert([
                        'doctor_id'  => $row->doctor_id,
                        'day'        => $row->day,
                        'start_time' => $row->start_time_2,
                        'end_time'   => $row->end_time_2,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // Step 2: Drop the session 2 columns
            Schema::table('schedules', function (Blueprint $table) {
                $table->dropColumn(['start_time_2', 'end_time_2']);
            });
        }
    }

    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->time('start_time_2')->nullable()->after('end_time');
            $table->time('end_time_2')->nullable()->after('start_time_2');
        });
    }
};
