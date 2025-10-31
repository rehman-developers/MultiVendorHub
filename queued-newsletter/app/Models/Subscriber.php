<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;  

class Subscriber extends Model
{
    use HasFactory, Notifiable;   

    protected $fillable = [
        'name',
        'email',
        'profile_pic',
        'status'
    ];

    protected $casts = [
        'status' => 'string'
    ];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}