<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('authenticated users can post comments with their email', function () {
    $user = User::factory()->create([
        'email' => 'reader@example.com',
    ]);

    $post = Post::create([
        'title' => 'Test Post',
        'content' => 'Test content',
    ]);

    $this->actingAs($user)
        ->post(route('comments.store', $post), [
            'content' => 'This is a saved comment.',
        ])
        ->assertRedirect(route('posts.show', $post));

    $this->assertDatabaseHas('comments', [
        'post_id' => $post->id,
        'email' => 'reader@example.com',
        'content' => 'This is a saved comment.',
    ]);

    $this->get(route('posts.show', $post))
        ->assertSee('reader@example.com')
        ->assertSee('This is a saved comment.');
});

test('guests cannot post comments', function () {
    $post = Post::create([
        'title' => 'Test Post',
        'content' => 'Test content',
    ]);

    $this->post(route('comments.store', $post), [
        'content' => 'Blocked comment.',
    ])->assertRedirect(route('login'));
});
