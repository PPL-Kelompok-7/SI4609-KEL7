<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'rating',
        'comment'
    ];

    // Relationship with Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
