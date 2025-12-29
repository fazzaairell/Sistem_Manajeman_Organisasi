<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'image', 
<<<<<<< HEAD
        'date',
        'description', 
        'content'
=======
        'date', 
        'content',
        'description'
>>>>>>> 0b0ceb857a56aa91ab0da1ec4d78d9a5ec788d12
    ];
}
