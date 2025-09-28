<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogReaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_id',
        'ip_address',
        'type',
    ];

    protected $casts = [
        'blog_id' => 'integer',
    ];

    // Relationships
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    // Validation rules
    public static function rules()
    {
        return [
            'blog_id' => 'required|exists:blogs,id',
            'ip_address' => 'required|ip',
            'type' => 'required|in:like,dislike',
        ];
    }
}
