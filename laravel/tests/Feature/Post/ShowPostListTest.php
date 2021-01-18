<?php

namespace Tests\Feature\Post;

use App\Models\User;
use App\Models\Post;
use App\Http\Controllers\PostController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ShowPostListTest extends TestCase
{
    use RefreshDatabase;

    public function test_post_list_screen_can_be_rendered()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->get('/posts');

        $response->assertStatus(200);
    }

    public function test_single_post_list_can_got()
    {
        $this->actingAs($user = User::factory()->create());
        $user->posts()->save(Post::factory()->make());

        $this->assertCount(1, $user->posts()->get());
    }

    public function test_multiple_post_list_can_got()
    {
        $this->actingAs($user = User::factory()->create());
        $user->posts()->saveMany(Post::factory()->count(5)->make());

        $this->assertCount(5, $user->posts()->get());
    }

    public function test_empty_post_list_can_got()
    {
        $this->actingAs($user = User::factory()->create());

        $this->assertCount(0, $user->posts()->get());
    }

    public function test_cannot_got_other_users_post()
    {
        $this->actingAs($user = User::factory()->create());
        $other_user = User::factory()->create();
        $other_user->posts()->saveMany(Post::factory()->count(5)->make());
        $user->fresh();

        $this->assertCount(0, $user->posts()->get());
    }
}
