<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'client_name',
        'client_email',
        'client_phone',
        'service_id',
        'appointment_datetime',
        'status',
        'message',
        'admin_notes',
        'is_first_session',
        'preferred_language',
        'ip_address',
    ];

    protected $casts = [
        'appointment_datetime' => 'datetime',
        'is_first_session' => 'boolean',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}
