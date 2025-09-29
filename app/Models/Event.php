<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'type',
        'status',
        'featured_image',
        'gallery',
        'price',
        'duration',
        'max_participants',
        'current_participants',
        'event_date',
        'registration_deadline',
        'location',
        'requirements',
        'benefits',
        'program',
        'is_featured',
        'is_active',
        'allow_registration',
        'sort_order',
        'seo_title',
        'seo_description',
    ];

    protected $translatable = [
        'title',
        'description',
        'content',
        'location',
        'requirements',
        'benefits',
        'program',
        'seo_title',
        'seo_description',
    ];

    protected $casts = [
        'gallery' => 'array',
        'location' => 'array',
        'requirements' => 'array',
        'benefits' => 'array',
        'program' => 'array',
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'allow_registration' => 'boolean',
        'event_date' => 'datetime',
        'registration_deadline' => 'datetime',
    ];

    // Boot method to auto-generate slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->getTranslation('title', 'en') ?: $event->getTranslation('title', 'fr'));
            }
        });
        
        static::updating(function ($event) {
            if ($event->isDirty('title') && empty($event->slug)) {
                $event->slug = Str::slug($event->getTranslation('title', 'en') ?: $event->getTranslation('title', 'fr'));
            }
        });
    }

    // Relationships
    public function applications()
    {
        return $this->hasMany(EventApplication::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopePractical($query)
    {
        return $query->where('type', 'practical');
    }

    public function scopeWorkshop($query)
    {
        return $query->where('type', 'workshop');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'upcoming');
    }

    public function scopeActiveStatus($query)
    {
        return $query->where('status', 'active');
    }

    // Accessors
    public function getAvailableSpotsAttribute()
    {
        if (!$this->max_participants) {
            return null;
        }
        return $this->max_participants - $this->current_participants;
    }

    public function getIsFullAttribute()
    {
        if (!$this->max_participants) {
            return false;
        }
        return $this->current_participants >= $this->max_participants;
    }

    public function getCanRegisterAttribute()
    {
        return $this->allow_registration 
            && !$this->is_full 
            && $this->is_active 
            && in_array($this->status, ['active', 'upcoming'])
            && (!$this->registration_deadline || now() <= $this->registration_deadline);
    }
}
