<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // One-to-Many: Teacher has many Students
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    // Many-to-Many: Teacher teaches many Subjects
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
