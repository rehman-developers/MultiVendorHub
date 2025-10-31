<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
    'email_verified_at' => 'datetime',
    'role' => 'integer', // ← Ensures role is always string
    'status' => 'string',
    ];

    protected $attributes = [
    'role' => 3,
    'status'=>'active'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => 'string',
        ];
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'buyer_id');
    }

    public function store()
    {
        return $this->hasOne(Store::class, 'seller_id');
    }

    // app/Models/User.php
    public function isSuperAdmin(): bool
    {
        return $this->role == 0 && $this->status == 'active';
    }

    public function isAdmin(): bool
    {
        return $this->role == 1 && $this->status == 'active';
    }

    public function isSeller(): bool
    {
        return $this->role == 2 && $this->status == 'active';
    }

    public function isBuyer(): bool
    {
        return $this->role == 3 && $this->status == 'active';
    }

    public function isPending()
    {
        return $this->status == 'pending';
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'buyer_id');
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class, 'buyer_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'seller_id');
    }
}