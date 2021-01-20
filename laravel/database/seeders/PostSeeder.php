<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create();
        $user->posts()->saveMany(
            Post::factory()->count(5)->make()
        );
        $user->name="user";
        $user->email="test@example.com";
        $user->password=bcrypt("password");
        $user->save();
    }
}
