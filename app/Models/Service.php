<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    // Note: getRouteKeyName removed to fix Filament table actions
    // Frontend routes now use explicit binding: Route::get('/services/{service:slug}', ...)

    public function images()
    {
        return $this->hasMany(ServiceImage::class);
    }
}
