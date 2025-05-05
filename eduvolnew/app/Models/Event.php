<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'terms',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'location',
        'max_participants',
        'price',
        'event_photo',
        'status_id',
        'created_by'
    ];

    // Relationship with EventStatus
    public function status()
    {
        return $this->belongsTo(EventStatus::class, 'status_id');
    }

    // Relationship with User (creator)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
