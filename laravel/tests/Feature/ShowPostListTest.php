<?php

namespace Tests\Feature;

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
        $response = $this->get('/post');

        $this->assertStatus(200);
    }

    public function test_post_list_can_got()
    {
        $this->actingAs($post = Post::factory()->create());
        $this->assertTrue(False);
    }

    public function test_multiple_post_list_can_got()
    {
        $this->assertTrue(False);
    }

    public function test_empty_post_list_can_got()
    {
        $this->assertTrue(False);
    }

    public function test_not_got_other_users_post()
    {
        $this->assertTrue(False);
    }
}
