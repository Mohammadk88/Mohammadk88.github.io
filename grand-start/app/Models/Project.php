<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ar', 'title_en', 'title_ku',
        'slug',
        'description_ar', 'description_en', 'description_ku',
        'location_ar', 'location_en', 'location_ku',
        'price_usd', 'price_iqd',
        'area', 'floors', 'units',
        'status', 'type',
        'featured', 'active',
        'main_image',
        'video_url',
        'latitude', 'longitude',
        'delivery_date',
        'sort_order',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'active' => 'boolean',
        'price_usd' => 'decimal:2',
        'price_iqd' => 'decimal:0',
        'delivery_date' => 'date',
    ];

    public function images()
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }

    public function features()
    {
        return $this->hasMany(ProjectFeature::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function getTitle(): string
    {
        $locale = app()->getLocale();
        return $this->{"title_{$locale}"} ?? $this->title_ar ?? $this->title_en ?? '';
    }

    public function getDescription(): string
    {
        $locale = app()->getLocale();
        return $this->{"description_{$locale}"} ?? $this->description_ar ?? $this->description_en ?? '';
    }

    public function getLocation(): string
    {
        $locale = app()->getLocale();
        return $this->{"location_{$locale}"} ?? $this->location_ar ?? $this->location_en ?? '';
    }

    public function getPrice(string $currency = 'usd'): string
    {
        if ($currency === 'iqd' && $this->price_iqd) {
            return number_format($this->price_iqd, 0) . ' د.ع';
        }
        if ($this->price_usd) {
            return '$' . number_format($this->price_usd, 0);
        }
        return __('app.price_on_request');
    }

    public function getMainImageUrl(): string
    {
        if ($this->main_image) {
            return asset('uploads/' . $this->main_image);
        }
        return asset('images/project-placeholder.jpg');
    }

    public function getStatusLabel(): string
    {
        return match($this->status) {
            'available' => __('app.available'),
            'sold_out' => __('app.sold_out'),
            'under_construction' => __('app.under_construction'),
            'coming_soon' => __('app.coming_soon'),
            default => __('app.available'),
        };
    }

    public function getTypeLabel(): string
    {
        return match($this->type) {
            'residential' => __('app.residential'),
            'commercial' => __('app.commercial'),
            'villa' => __('app.villa'),
            'apartment' => __('app.apartment'),
            'compound' => __('app.compound'),
            'tower' => __('app.tower'),
            default => __('app.residential'),
        };
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title_en ?? $project->title_ar) . '-' . Str::random(6);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }
}
