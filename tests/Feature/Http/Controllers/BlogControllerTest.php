<?php

use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

it('can_create_blog', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $response = $this->post('/api/blogs', [
        'title' => 'Test Blog',
        'description' => 'Test Description',
        'content' => 'Test Content',
        'is_published' => true,
    ], [
        'Accept' => 'application/json',
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('blogs', [
        'title' => 'Test Blog',
        'description' => 'Test Description',
        'content' => 'Test Content',
        'is_published' => true,
        'user_id' => $user->id,
    ]);
});

it('can_update_blog', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);
    $blog = Blog::factory()->create();
    $response = $this->put('/api/blogs/' . $blog->id, [
        'title' => 'Updated Blog',
        'description' => 'Updated Description',
        'content' => 'Updated Content',
        'is_published' => true,
    ], [
        'Accept' => 'application/json',
    ]);
    $response->assertStatus(200);
    $this->assertDatabaseHas('blogs', [
        'title' => 'Updated Blog',
        'description' => 'Updated Description',
        'content' => 'Updated Content',
        'is_published' => true,
    ]);
});

it('can_delete_blog', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);
    $blog = Blog::factory()->create();
    $response = $this->delete('/api/blogs/' . $blog->id, [], [
        'Accept' => 'application/json',
    ]);
    $response->assertStatus(204);
});

it('can_get_all_blogs', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);
    Blog::factory()->count(20)->create();
    $response = $this->get('/api/blogs', [
        'Accept' => 'application/json',
    ]);
    $response->assertStatus(200);
    $response->assertJsonCount(20);
    $response->assertJsonStructure([
        '*' => [
            'id',
            'title',
            'description',
            'content',
            'is_published',
            'user_id',
            'created_at',
            'updated_at',
        ],
    ]);
});
