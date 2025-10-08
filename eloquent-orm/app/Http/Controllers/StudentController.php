<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::paginate(4);
        return view('welcome',compact('students'));
        // $students = Student::find(2);
        // return $students;
        // foreach ($students as $student) {
        //     echo $student -> name."<br>";
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addStudent');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $student = new Student;

        $student->name = $request->stname;
        $student->email = $request->stemail;
        $student->age = $request->stage;
        $student->city = $request->stcity;

        $student->save();
        return redirect()->route('student.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $students = Student::find($student);
        // return $student;
        return view('viewstudent',compact('students'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $students = Student::find($student->id);
        return view('updateStudent',compact('students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {

        $student->name = $request->stname;
        $student->email = $request->stemail;
        $student->age = $request->stage;
        $student->city = $request->stcity;

        $student->save();
        return redirect()->route('student.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        // $students = Student::find($student);
        $student->delete();
        return redirect()->route('student.index');
    }
}
