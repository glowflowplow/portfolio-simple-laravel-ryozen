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

        $response->assertRedirect('/posts');
        $this->assertEquals('test updated message', $post->fresh()->message);
        $this->assertCount(5, $user->posts()->get());
    }

    public function test_failed_to_update_deleted_post()
    {
        $this->actingAs($user = User::factory()->create());
        $user->posts()->saveMany(Post::factory()->count(5)->make());

        $post = $user->posts()->first();
        $id = $post->id;
        $post->delete();

        $response = $this->post("/posts/{$id}/edit", [
            'message' => 'test updated message'
        ]);

        $response->assertStatus(404);
        $this->assertCount(0, $user->posts()->get()->where('message', 'LIKE', '%update%'));
        $this->assertCount(4, $user->posts()->get());
    }
}
