<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Subject;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacher = Teacher::create(['name' => 'Miss Ayesha']);
        $teacher2 = Teacher::create(['name' => 'Sir Ahmed']);

        Student::create(['name' => 'Ali', 'teacher_id' => $teacher->id]);
        Student::create(['name' => 'Sara', 'teacher_id' => $teacher->id]);
        Student::create(['name' => 'Bilal', 'teacher_id' => $teacher2->id]);

        $math = Subject::create(['title' => 'Math']);
        $science = Subject::create(['title' => 'Science']);

        $teacher->subjects()->attach([$math->id, $science->id]);
        $teacher2->subjects()->attach([$math->id]);
    }
}
