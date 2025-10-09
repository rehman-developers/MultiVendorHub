<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    // Many-to-Many: Subject can have many Teachers
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }
}

