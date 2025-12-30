<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'image', 
        'title', 
        'status', 
        'start_date', 
        'end_date', 
        'description', 
        'penanggung_jawab'
    ];

    /**
     * Relasi ke EventRegistration
     */
    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    /**
     * Relasi ke EventRegistration dengan status pending
     */
    public function pendingRegistrations()
    {
        return $this->hasMany(EventRegistration::class)->where('status', 'pending');
    }

    /**
     * Relasi ke EventRegistration dengan status approved
     */
    public function approvedRegistrations()
    {
        return $this->hasMany(EventRegistration::class)->where('status', 'approved');
    }
}