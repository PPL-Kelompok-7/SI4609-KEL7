<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeachingSession extends Model
{
    protected $fillable = ['user_id', 'duration'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
