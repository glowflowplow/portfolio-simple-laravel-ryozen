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
        User::factory()
            ->create()
            ->each(function(User $user) {
                $user->posts()->saveMany(
                    Post::factory()->count(5)->make()
                );
            });
    }
}
