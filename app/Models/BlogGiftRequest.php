<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

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
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public const STATUS_PENDING = 'pending';
    public const STATUS_PROCESSED = 'processed';

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeProcessed($query)
    {
        return $query->where('status', self::STATUS_PROCESSED);
    }

    public function getFullNameAttribute(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    public function getStatusBadgeAttribute(): HtmlString
    {
        return new HtmlString(match ($this->status) {
            self::STATUS_PROCESSED => '<span class="badge bg-success">Processed</span>',
            default => '<span class="badge bg-warning text-dark">Pending</span>',
        });
    }

    public function getFormattedCreatedAtAttribute(): string
    {
        return $this->created_at?->format('d/m/Y H:i') ?? '';
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
