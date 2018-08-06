<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(\App\User::class)->create();

        factory(\App\Post::class,50)->create(['user_id' => $user->id])->each(function ($post){
            factory(\App\PostImage::class,rand(1,5))->create(['post_id' => $post->id]);
        });

        // $this->call(UsersTableSeeder::class);
    }
}
