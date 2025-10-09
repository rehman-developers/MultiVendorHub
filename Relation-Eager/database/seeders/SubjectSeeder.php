<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
 
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $math = Subject::create(['title' => 'Math']);
        $science = Subject::create(['title' => 'Science']);
        $history = Subject::create(['title' => 'History']);

        // Attach subjects to teachers (many-to-many)
        Teacher::find(1)->subjects()->attach([$math->id, $science->id]); // Mr. Smith teaches Math and Science
        Teacher::find(2)->subjects()->attach([$science->id, $history->id]); // Ms. Johnson teaches Science and History
        Teacher::find(3)->subjects()->attach([$math->id, $history->id]); // Dr. Lee teaches Math and History
    }
}
