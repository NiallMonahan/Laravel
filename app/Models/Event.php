<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // These are the fields we actually want to fill in one go
    protected $fillable = [
        'title',
        'description',
        'event_date',
        'location',
        'image',
    ];
}
