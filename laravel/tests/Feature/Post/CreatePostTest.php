<?php

namespace Tests\Feature\Post;

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
        $this->actingAs($user = User::factory()->create());
        $response = $this->get('/posts');
        $response->assertStatus(200);
    }

    public function test_create_post()
    {
        $this->actingAs($user = User::factory()->create());
        $response = $this->post('/posts/create', [
            'message' => 'test message'
        ]);

        $response->assertRedirect('/posts');
        $this->assertSame('test message', $user->fresh()->posts()->first()->message);
    }

    public function test_reload_create_post_screen_if_send_empty_message()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->post('/posts/create', [
            'message' => ''
        ]);

        $response->assertRedirect();
    }
}
