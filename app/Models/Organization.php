<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'name',
        'short_name',
        'logo',
        'address',
        'email',
        'phone',
        'website',
        'founded_year',
    ];
}

