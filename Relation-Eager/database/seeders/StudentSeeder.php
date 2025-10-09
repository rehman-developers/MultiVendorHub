<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
 
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Student::create(['name' => 'Alice', 'teacher_id' => 1]); // Assigned to Mr. Smith
        Student::create(['name' => 'Bob', 'teacher_id' => 1]);
        Student::create(['name' => 'Charlie', 'teacher_id' => 2]); // Assigned to Ms. Johnson
        Student::create(['name' => 'David', 'teacher_id' => 2]);
        Student::create(['name' => 'Eve', 'teacher_id' => 3]); // Assigned to Dr. Lee
    }
}
