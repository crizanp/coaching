<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'description', 
        'content',
        'slug',
        'benefits',
        'session_format',
        'price_individual',
        'price_group',
        'duration',
        'icon',
        'is_featured',
        'is_active',
        'sort_order',
        'seo_title',
        'seo_description',
    ];

    protected $translatable = [
        'name',
        'description',
        'content',
        'benefits',
        'session_format',
        'seo_title',
        'seo_description',
    ];

    protected $casts = [
        'benefits' => 'array',
        'session_format' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'price_individual' => 'decimal:2',
        'price_group' => 'decimal:2',
    ];

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
