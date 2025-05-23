<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;

class Wishlist extends Model
{
    protected $fillable = ['user_id', 'event_id'];

    /**
     * Get the event that belongs to the wishlist item.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
