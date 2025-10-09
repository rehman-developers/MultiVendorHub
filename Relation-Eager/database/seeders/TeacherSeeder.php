<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        Teacher::create(['name' => 'Mr. Smith']);
        Teacher::create(['name' => 'Ms. Johnson']);
        Teacher::create(['name' => 'Dr. Lee']);
    }
}
