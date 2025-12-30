<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'category',
        'priority',
        'status',
        'date',
        'expires_at',
        'description',
        'content',
        'author',
        'image',
    ];

    protected $casts = [
        'date' => 'date',
        'expires_at' => 'date',
    ];

    // Scope untuk announcement yang published
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope untuk announcement yang belum expired
    public function scopeActive($query)
    {
        return $query->where(function($q) {
            $q->whereNull('expires_at')
              ->orWhere('expires_at', '>=', now());
        });
    }

    // Check apakah announcement urgent
    public function isUrgent()
    {
        return $this->priority === 'urgent';
    }

    // Check apakah announcement penting
    public function isPenting()
    {
        return $this->priority === 'penting';
    }
}
