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

    const ROLE_CUSTOMER = 1;
    const ROLE_DELIVERY_PERSON = 2;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
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
        'password' => 'hashed',
    ];

    /**
     * Returns the favorite products of the user
     */
    public function favorites()
    {
        return $this->hasManyThrough(
            Product::class,
            Favorite::class,
            'user_id',
            'id',
            'id',
            'product_id',
        );
    }

    public function profileImage()
    {
        return $this->hasOne(ImageLink::class)->pluck('link');
    }

    public function cart()
    {
        return $this->hasMany(CartItem::class);
    }
}
