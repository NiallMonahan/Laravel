<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable = [
        'name',
        'bio',
        'genre',
    ];

    /**
     * Define the many-to-many relationship with Event
     * An artist can perform at multiple events
     * Uses the 'artist_event' pivot table
     */
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

}
