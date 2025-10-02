<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogGiftRequest extends Model
{
    protected $fillable = [
        'blog_id',
        'blog_slug',
        'blog_title',
        'locale',
        'first_name',
        'last_name',
        'email',
        'phone',
        'status',
        'processed_at',
        'admin_notes',
        'ip_address',
    ];

    protected $casts = [
        'processed_at' => 'datetime',
    ];

    public const STATUS_PENDING = 'pending';
    public const STATUS_PROCESSED = 'processed';

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function markAsProcessed(?string $notes = null): void
    {
        $this->forceFill([
            'status' => self::STATUS_PROCESSED,
            'processed_at' => now(),
            'admin_notes' => $notes,
        ])->save();
    }
}
