<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $json = File::get(path:'database/json/student.json');
        $json = File::get(base_path('database/json/students.json'));
        $students = collect(json_decode($json));

        $students->each(function($student){

            Student::create([
                'name'=>$student->name,
                'email'=>$student->email,
                'age'=>$student->age,
                'city'=>$student->city
            ]);
        });
    }
}
