<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Guide extends Model
{
    protected $fillable = [
        'title',
        'slug', 
        'description',
        'icon',
        'benefits',
        'file_path',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'benefits' => 'array',
        'is_active' => 'boolean'
    ];

    // Automatically generate slug when creating/updating
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($guide) {
            if (empty($guide->slug)) {
                $guide->slug = Str::slug($guide->title);
            }
        });
        
        static::updating(function ($guide) {
            if ($guide->isDirty('title') && empty($guide->getOriginal('slug'))) {
                $guide->slug = Str::slug($guide->title);
            }
        });
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at');
    }

    // Relationships
    public function downloads()
    {
        return $this->hasMany(GuideDownload::class, 'guide_slug', 'slug');
    }

    // Helper methods
    public function getTotalDownloadsAttribute()
    {
        return $this->downloads()->count();
    }
}
