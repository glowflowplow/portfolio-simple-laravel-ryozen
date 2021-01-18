<?php

namespace Tests\Feature\Post;

use App\Models\User;
use App\Models\Post;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker;

class UpdatePostTest extends TestCase
{
    use RefreshDatabase;

    public function test_edit_screen_can_rendered(){
        $this->actingAs($user = User::factory()->create());
        $user->posts()->save(Post::factory()->make());

        $id = $user->posts()->first()->id;
        $response = $this->get("/posts/{$id}/edit");

        $response->assertStatus(200);
    }

    public function test_update_post()
    {
        $this->actingAs($user = User::factory()->create());
        $user->posts()->saveMany(Post::factory()->count(5)->make());

        $post = $user->posts()->first();
        $response = $this->post("/posts/{$post->id}/edit", [
            'message' => 'test updated message'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/posts');
        $this->assertEquals('test updated message', $post->fresh()->message);
    }

    public function test_failed_to_update_deleted_post()
    {
        $this->actingAs($user = User::factory()->create());
        $user->posts()->saveMany(Post::factory()->count(5)->make());

        $id = $user->posts()->first()->id;
        $user->posts()->delete($id);
        $response = $this->post("/posts/{$id}/edit", [
            'message' => 'test updated message'
        ]);

        $response->assertStatus(404);
        $response->assertRedirect('/posts');
    }
}
