<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageVisit extends Model
{
    protected $fillable = [
        'url',
        'page_name',
        'ip_address',
        'session_id',
        'user_agent',
        'referer',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Ambil kunjungan hari ini
     */
    public static function today(): int
    {
        return static::whereDate('created_at', today())->count();
    }

    /**
     * Ambil kunjungan minggu ini
     */
    public static function thisWeek(): int
    {
        return static::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
    }

    /**
     * Ambil kunjungan bulan ini
     */
    public static function thisMonth(): int
    {
        return static::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
    }

    /**
     * Ambil halaman paling populer
     */
    public static function popularPages(int $limit = 10): \Illuminate\Support\Collection
    {
        return static::selectRaw('page_name, url, COUNT(*) as visit_count')
            ->groupBy('page_name', 'url')
            ->orderByDesc('visit_count')
            ->limit($limit)
            ->get();
    }

    /**
     * Data kunjungan per hari (30 hari terakhir)
     */
    public static function dailyVisits(int $days = 30): \Illuminate\Support\Collection
    {
        return static::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }
}
