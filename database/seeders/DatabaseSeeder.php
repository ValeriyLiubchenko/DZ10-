<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $users =  \App\Models\User::factory(10)->create();
       $categories =  \App\Models\Category::factory(25)->create();
        $tags = Tag::factory(100)->create();
       $posts = \App\Models\Post::factory(100)->make()->each(function ($post) use ($users , $categories, $tags){
            $post->user_id = $users->random()->id;
            $post->category_id = $categories->random()->id;
            $post->save();
            $post->tags()->attach($tags->random(5));
        });


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
