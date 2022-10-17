<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            $post = new Post();
            $post->title = fake()->sentence(10);
            $post->description = fake()->sentence(10);
            $post->is_saleable = true;
            $post->price = 100;
            $post->favorite_count = 0;
            $post->view_count = 0;
            $post->save();
        }
    }
}
