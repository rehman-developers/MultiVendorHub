<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'description',
        'subscriber_id'
    ];

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }
}