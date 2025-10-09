<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function showTeachers()
    {
        // ❌ Without Eager Loading
        // $teachers = Teacher::all();

        // ✅ With Eager Loading
        $teachers = Teacher::with(['students', 'subjects'])->get();

        return view('teachers', compact('teachers'));
    }
}
