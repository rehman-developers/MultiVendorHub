<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function showStudent(){

        $students = DB::table('student')->paginate(4);
        return view('welcome',['data' => $students]);
        // $students = DB::table('student')
        // ->select('name','age')
        // ->where('city','kar') //in which you can see just (kar) city student
        // ->pluck('name') // in which you can use just one parameter
        // ->distinct() // no repeat the value
        // ->get();
        // return $students;
        // dd($student);
        // dump($student);
    }
    public function singleStudent(string $id){
        //  $student = DB::table('student')->find($id);
         $student = DB::table('student')->where('id',$id)->get();
        return view('student',['data'=> $student]);
    }

    public function addstudent(Request $req){
        $student = DB::table('student')->insert([
            'name'=> $req->stname,
            'email'=> $req->stemail,
            'age'=> $req->stage,
            'city'=> $req->stcity,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
         // dd($student);
            // return redirect()->route('home');
            if($student){
                return redirect()->route('home');
            }
         
    }
     public function updatePage($id){
        //    $student = DB::table('student')->where('id',$id)->get();
           $student = DB::table('student')->find($id);
        return view('updateStudent',['data'=>$student]);
    }

    public function updateStudent(Request $req, $id){
        $student = DB::table('student')->where('id',$id)->update([
                 'name'=> $req->stname,
            'email'=> $req->stemail,
            'age'=> $req->stage,
            'city'=> $req->stcity
        ]);
        if($student){
            return redirect()->route('home');
        }

    }

    public function deleteStudent($id){
        $student = DB::table('student')
        ->where('id',$id)
        ->delete();
        if($student){
            return redirect()->route('home');
        }
    }

}
