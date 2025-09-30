<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class GuideDownload extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'ip_address',
        'guide_slug',
        'guide_title',
        'guide_description',
        'guide_file_path',
        'status',
        'approved_at',
        'sent_at',
        'admin_notes'
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'sent_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeSent($query)
    {
        return $query->where('status', 'sent');
    }

    // Relationships
    public function guide()
    {
        return $this->belongsTo(Guide::class, 'guide_slug', 'slug');
    }

    // Accessors
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => '<span class="badge bg-warning">Pending</span>',
            'approved' => '<span class="badge bg-success">Approved</span>',
            'sent' => '<span class="badge bg-info">Sent</span>',
            'rejected' => '<span class="badge bg-danger">Rejected</span>',
        };
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('d/m/Y H:i');
    }

    // Methods
    public function approve()
    {
        $this->update([
            'status' => 'approved',
            'approved_at' => now()
        ]);
    }

    public function markAsSent()
    {
        $this->update([
            'status' => 'sent',
            'sent_at' => now()
        ]);
    }

    public function reject($reason = null)
    {
        $this->update([
            'status' => 'rejected',
            'admin_notes' => $reason
        ]);
    }

    // Check if IP has already requested this specific guide recently (24 hours)
    public static function hasRecentRequest($ip, $guideSlug, $hours = 24)
    {
        return self::where('ip_address', $ip)
            ->where('guide_slug', $guideSlug)
            ->where('created_at', '>=', Carbon::now()->subHours($hours))
            ->exists();
    }
}
