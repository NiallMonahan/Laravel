<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'event_id',
        'holder_name',
        'seat_number',
        'price',
    ];

    /**
     * Define the many-to-one relationship with Event
     * Each ticket belongs to one event
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Define the many-to-one relationship with User
     * Each ticket can be associated with a user (ticket holder)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
