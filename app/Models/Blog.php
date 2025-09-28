<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_published',
        'published_at',
        'views_count',
        'likes_count',
        'dislikes_count',
    ];

    protected $casts = [
        'meta_keywords' => 'array',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'views_count' => 'integer',
        'likes_count' => 'integer',
        'dislikes_count' => 'integer',
    ];

    // Boot method to auto-generate slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }
            
            if (empty($blog->meta_title)) {
                $blog->meta_title = $blog->title;
            }
            
            if (empty($blog->meta_description)) {
                $blog->meta_description = Str::limit(strip_tags($blog->excerpt), 160);
            }
        });
        
        static::updating(function ($blog) {
            if ($blog->isDirty('title') && empty($blog->getOriginal('slug'))) {
                $blog->slug = Str::slug($blog->title);
            }
        });
    }

    // Relationships
    public function reactions()
    {
        return $this->hasMany(BlogReaction::class);
    }

    public function likes()
    {
        return $this->reactions()->where('type', 'like');
    }

    public function dislikes()
    {
        return $this->reactions()->where('type', 'dislike');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                    ->where('published_at', '<=', now());
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    // Accessors
    public function getReadingTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $readingTime = ceil($wordCount / 200); // Average reading speed: 200 words per minute
        return max(1, $readingTime);
    }

    public function getFormattedPublishedAtAttribute()
    {
        return $this->published_at ? $this->published_at->format('M d, Y') : null;
    }

    // Methods
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    public function getReactionByIp($ipAddress)
    {
        return $this->reactions()->where('ip_address', $ipAddress)->first();
    }

    public function canReact($ipAddress)
    {
        return !$this->reactions()->where('ip_address', $ipAddress)->exists();
    }

    public function addReaction($type, $ipAddress)
    {
        try {
            // Check if user already has a reaction
            $existingReaction = $this->reactions()->where('ip_address', $ipAddress)->first();
            
            if ($existingReaction) {
                return false; // User already has a reaction
            }

            $reaction = $this->reactions()->create([
                'type' => $type,
                'ip_address' => $ipAddress,
            ]);

            // Update counters
            if ($type === 'like') {
                $this->increment('likes_count');
            } else {
                $this->increment('dislikes_count');
            }

            return $reaction;
        } catch (\Exception $e) {
            Log::error('Error adding blog reaction: ' . $e->getMessage(), [
                'blog_id' => $this->id,
                'type' => $type,
                'ip_address' => $ipAddress
            ]);
            return false;
        }
    }

    public function removeReaction($ipAddress)
    {
        try {
            $reaction = $this->reactions()->where('ip_address', $ipAddress)->first();
            
            if ($reaction) {
                if ($reaction->type === 'like') {
                    $this->decrement('likes_count');
                } else {
                    $this->decrement('dislikes_count');
                }
                
                $reaction->delete();
                return true;
            }
            
            return false;
        } catch (\Exception $e) {
            Log::error('Error removing blog reaction: ' . $e->getMessage(), [
                'blog_id' => $this->id,
                'ip_address' => $ipAddress
            ]);
            return false;
        }
    }
}
