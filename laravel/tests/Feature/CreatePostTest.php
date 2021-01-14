<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    use RefreshDatabase;

    public function test_posting_screen_can_be_rendered()
    {
        $response = $this->get('/posts');

        $response->assertStatus(200);
    }

    public function test_create_post()
    {
        $this->actingAs($post = Post::factory()->create());
        $response = $this->post('/posts/create', [
            'message' => 'test message'
        ]);

        $response->assertRedirect(RouteServiceProvider::PostsList);
        $this->assertSame('test message', $user->fresh()->message);
    }

    public function test_failed_to_create_post_when_empty_message()
    {
        $response = $this->post('/posts/create', [
            'message' => ''
        ]);

        $response->assertRedirect();
    }
}
