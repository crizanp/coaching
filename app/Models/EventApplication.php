<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventApplication extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'email',
        'phone',
        'company',
        'message',
        'status',
        'notes',
        'ip_address',
        'confirmed_at',
        'status_updated_at',
    ];

    protected $casts = [
        'confirmed_at' => 'datetime',
        'status_updated_at' => 'datetime',
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

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopeWaitlist($query)
    {
        return $query->where('status', 'waitlist');
    }

    // Mutators
    public function setStatusAttribute($value)
    {
        $oldStatus = $this->attributes['status'] ?? null;
        $this->attributes['status'] = $value;
        
        if ($oldStatus !== $value) {
            $this->attributes['status_updated_at'] = now();
        }
        
        if ($value === 'confirmed') {
            $this->attributes['confirmed_at'] = now();
        }
    }

    // Accessors
    public function getParticipantNameAttribute()
    {
        return $this->name;
    }

    public function getParticipantEmailAttribute()
    {
        return $this->email;
    }
}
