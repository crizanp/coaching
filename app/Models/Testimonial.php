<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model
{
    use HasTranslations;

    protected $fillable = [
        'client_name',
        'client_location',
        'testimonial',
        'rating',
        'service_id',
        'is_featured',
        'is_active',
        'testimonial_date',
    ];

    protected $translatable = [
        'testimonial',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'testimonial_date' => 'date',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
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
