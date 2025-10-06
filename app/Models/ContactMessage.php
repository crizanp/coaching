<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Service;

class ContactMessage extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'service_id', 'message'
    ];
    
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
