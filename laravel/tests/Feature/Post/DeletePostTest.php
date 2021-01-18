<?php

namespace Tests\Feature\Post;

use App\Models\User;
use App\Models\Post;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeletePostTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_post()
    {
        $this->actingAs($user = User::factory()->create());
        $user->posts()->saveMany(Post::factory()->count(5)->make());

        $this->assertCount(5, $user->posts()->get());

        $id = $user->posts()->first()->id;
        $response = $this->post("/posts/{$id}/delete");

        $response->assertRedirect('/posts');
        $this->assertCount(4, $user->posts()->get());
    }

    public function test_delete_last_post()
    {
        $this->actingAs($user = User::factory()->create());
        $user->posts()->saveMany(Post::factory()->count(5)->make());

        $this->assertCount(5, $user->posts()->get());

        $id = $user->posts()->get()->last()->id;
        $response = $this->post("/posts/{$id}/delete");

        $response->assertRedirect('/posts');
        $this->assertCount(4, $user->posts()->get());
    }

    public function test_delete_only_post()
    {
        $this->actingAs($user = User::factory()->create());
        $user->posts()->saveMany(Post::factory()->count(1)->make());

        $this->assertCount(1, $user->posts()->get());

        $id = $user->posts()->first()->id;
        $response = $this->post("/posts/{$id}/delete");

        $response->assertRedirect('/posts');
        $this->assertCount(0, $user->posts()->get());
    }

    public function test_failed_to_delete_deleted_post()
    {
        $this->actingAs($user = User::factory()->create());
        $user->posts()->saveMany(Post::factory()->count(5)->make());

        $deleting_post_id = $user->posts()->first()->id;
        $user->posts()->delete($deleting_post_id);

        $response = $this->post("/posts/{$deleting_post_id}/delete");
        $response->assertStatus(404);
        $response->assertRedirect('/posts');

        $this->assertCount(4, $user->posts()->get());
    }
}
