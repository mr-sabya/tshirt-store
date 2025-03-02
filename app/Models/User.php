<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use \Rackbeat\UIAvatars\HasAvatar;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'is_verified',
        'password',
        'division_id',
        'city_id',
        'postcode',
        'address',
        'image',
        'is_admin',
        'is_designer',
        'is_approved',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_verified' => 'boolean',
        'is_admin' => 'boolean',
        'is_designer' => 'boolean',
        'is_approved' => 'boolean',
        'password' => 'hashed', // Automatically hashes passwords
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
