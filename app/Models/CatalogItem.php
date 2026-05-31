<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogItem extends Model
{
    protected $guarded = [];

    protected $casts = [
        'facilities' => 'array',
        'stops'      => 'array',
        'price'      => 'integer',
        'lat'        => 'float',
        'lng'        => 'float',
    ];

    public function getImageUrlAttribute(): string
    {
        return $this->image
            ? asset('uploads/' . $this->image)
            : 'https://via.placeholder.com/640x480?text=No+Image';
    }

    public function getPriceFormattedAttribute(): string
    {
        return 'Rp' . number_format($this->price ?? 0, 0, ',', '.');
    }

    public function getCategoryBadgeClassAttribute(): string
    {
        return match ($this->category) {
            'Culinary' => 'cat-Culinary',
            'Kost' => 'cat-Kost',
            'BRT' => 'cat-BRT',
            default => 'cat-Culinary',
        };
    }
}
