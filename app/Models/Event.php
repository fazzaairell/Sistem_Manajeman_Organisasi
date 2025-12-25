<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'image', 
        'status', 
        'title', 
        'start_date', 
        'end_date', 
        'description'
    ];
}
