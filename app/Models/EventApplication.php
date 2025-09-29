<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventApplication extends Model
{
    protected $fillable = [
        'event_id',
        'applicant_name',
        'applicant_email',
        'applicant_phone',
        'applicant_age',
        'motivation',
        'special_requirements',
        'status',
        'notes',
        'applied_at',
        'processed_at',
    ];

    protected $casts = [
        'applied_at' => 'datetime',
        'processed_at' => 'datetime',
    ];

    // Relationships
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    // Mutators
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value;
        
        if (in_array($value, ['approved', 'rejected'])) {
            $this->attributes['processed_at'] = now();
        }
    }
}
