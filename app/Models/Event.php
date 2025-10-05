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

    /**
     * Get translated attribute value for the current locale
     */
    public function getLocalizedTranslation($key, $locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        $translation = $this->getTranslation($key, $locale);
        
        // If the translation is a JSON string, decode it and return the locale-specific value
        if (is_string($translation) && $this->isJson($translation)) {
            $decoded = json_decode($translation, true);
            if (is_array($decoded)) {
                // If the requested locale exists and is not null/empty, return it
                if (isset($decoded[$locale]) && !empty($decoded[$locale]) && $decoded[$locale] !== null) {
                    return $decoded[$locale];
                }
                // Fallback to French if current locale is null/empty
                if ($locale !== 'fr' && isset($decoded['fr']) && !empty($decoded['fr']) && $decoded['fr'] !== null) {
                    return $decoded['fr'];
                }
                // Fallback to English if French is also null/empty
                if ($locale !== 'en' && isset($decoded['en']) && !empty($decoded['en']) && $decoded['en'] !== null) {
                    return $decoded['en'];
                }
                // If all values are null/empty, return null instead of the JSON
                return null;
            }
        }
        
        return $translation;
    }

    /**
     * Check if a string is valid JSON
     */
    private function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}
