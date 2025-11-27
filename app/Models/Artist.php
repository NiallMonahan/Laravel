<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable = [
        'name',
        'bio',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

}
