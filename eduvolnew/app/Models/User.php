<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'profession',
        'domicile',
        'email',
        'password',
        'terms_agreed',
        'role_id',
        'profile_photo',
        'mobile_phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function teachingSessions()
    {
        return $this->hasMany(TeachingSession::class);
    }

    public function getProfilePhotoUrlAttribute()
    {
        if (!empty($this->profile_photo) && file_exists(public_path('storage/' . $this->profile_photo))) {
            return Storage::url($this->profile_photo);
        }
        return asset('profile2.png');
    }
}
