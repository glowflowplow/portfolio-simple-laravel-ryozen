<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteExpiredUserCommandTest extends TestCase
{
    use RefreshDatabase;

    private function run_command()
    {
        $this->artisan('command:delete_expired_users');
    }

    private function create_effective_user(int $count = 0)
    {
        User::factory()->count($count)->create();
    }

    private function create_expired_user(int $count = 0)
    {
        User::factory()->count($count)->create([
            'created_at' => Carbon::now()->subDays(7)
        ]);
    }

    /**
     * assertion | effective, expired | test name
     * 0 | 0, 0 | test_no_effective_no_expired_user_delete_no_users_after_delete_no_users
     * 0 | 0, 1 |
     * 0 | 0, 2
     * 1 | 1, 0
     * 1 | 1, 1 | test_delete_expired_user
     * 1 | 1, 2
     */
    /**
     * test related
     */
    public function test_delete_expired_user()
    {
        $this->create_expired_user(1);
        $this->assertCount(1, User::all());
        $this->run_command();
        $this->assertCount(0, User::all());
    }

    public function test_delete_user_with_related_posts()
    {
        User::factory()
        ->create([
            'created_at' => Carbon::now()->subDays(7)
        ])
        ->posts()
        ->saveMany(Post::factory()->count(5)->make());

        $this->assertCount(1, User::all());
        $this->assertCount(5, Post::all());

        $this->artisan('command:delete_expired_users');

        $this->assertCount(0, User::all());
        $this->assertCount(0, Post::all());
    }

    public function test_delete_expired_user_0_effective_0_expired()
    {
        $this->create_effective_user(0);
        $this->create_expired_user(0);
        $this->assertCount(0, User::all());
        $this->run_command();
        $this->assertCount(0, User::all());
    }

    public function test_delete_expired_user_0_effective_1_expired()
    {
        $this->create_effective_user(0);
        $this->create_expired_user(1);
        $this->assertCount(1, User::all());
        $this->run_command();
        $this->assertCount(0, User::all());
    }

    public function test_delete_expired_user_0_effective_2_expired()
    {
        $this->create_effective_user(0);
        $this->create_expired_user(2);
        $this->assertCount(2, User::all());
        $this->run_command();
        $this->assertCount(0, User::all());
    }

    public function test_delete_expired_user_1_effective_0_expired()
    {
        $this->create_effective_user(1);
        $this->create_expired_user(0);
        $this->assertCount(1, User::all());
        $this->run_command();
        $this->assertCount(1, User::all());
    }
    public function test_delete_expired_user_1_effective_1_expired()
    {
        $this->create_effective_user(1);
        $this->create_expired_user(1);
        $this->assertCount(2, User::all());
        $this->run_command();
        $this->assertCount(1, User::all());
    }
    public function test_delete_expired_user_1_effective_2_expired()
    {
        $this->create_effective_user(1);
        $this->create_expired_user(2);
        $this->assertCount(3, User::all());
        $this->run_command();
        $this->assertCount(1, User::all());
    }
}