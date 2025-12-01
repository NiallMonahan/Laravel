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
        'latitude',
        'longitude',
        'image',
    ];

    /**
     * Define the one-to-many relationship with Ticket
     * One event can have multiple tickets
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * Define the many-to-many relationship with Artist
     * An event can have multiple artists, and an artist can perform at multiple events
     * Uses the 'artist_event' pivot table
     */
    public function artists()
    {
        return $this->belongsToMany(Artist::class);
    }
}
