<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Facades\File;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=1;$i<=10;$i++){
                post::create([
                    'name' => fake()->name,
                    'email'=> fake()->unique()->email
                ]);
         
    }
    
}
    // $posts->each(function($post){
    //    });
    //   $json = File::get(path:'database/json/post.json');
    //   $posts = collect(json_decode($json));
    }