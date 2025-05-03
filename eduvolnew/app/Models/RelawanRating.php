<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelawanRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'volunteer_id',
        'rater_id',
        'event_id',
        'rating',
        'comment'
    ];

    // Relationship with User (Volunteer)
    public function volunteer()
    {
        return $this->belongsTo(User::class, 'volunteer_id');
    }

    // Relationship with User (Rater)
    public function rater()
    {
        return $this->belongsTo(User::class, 'rater_id');
    }

    // Relationship with Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
