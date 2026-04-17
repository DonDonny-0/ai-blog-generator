<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('non admins cannot access post management routes', function () {
    $user = User::factory()->create();
    $post = Post::create([
        'title' => 'Test Post',
        'content' => 'Test content',
    ]);

    $this->withoutExceptionHandling();

    expect(fn () => $this->actingAs($user)->get(route('admin')))
        ->toThrow(AuthorizationException::class);

    expect(fn () => $this->actingAs($user)->get(route('posts.edit', $post)))
        ->toThrow(AuthorizationException::class);

    expect(fn () => $this->actingAs($user)->put(route('posts.update', $post), [
            'title' => 'Updated title',
            'content' => 'Updated content',
        ]))
        ->toThrow(AuthorizationException::class);

    expect(fn () => $this->actingAs($user)->delete(route('posts.destroy', $post)))
        ->toThrow(AuthorizationException::class);
});

test('non admins do not see post management links', function () {
    $user = User::factory()->create();
    $post = Post::create([
        'title' => 'Test Post',
        'content' => 'Test content',
    ]);

    $this->actingAs($user)
        ->get(route('posts.index'))
        ->assertDontSee(route('admin'), false)
        ->assertDontSee(route('posts.edit', $post), false);

    $this->actingAs($user)
        ->get(route('posts.show', $post))
        ->assertDontSee(route('posts.edit', $post), false);
});

test('admins can access post management routes', function () {
    $admin = User::factory()->admin()->create();
    $post = Post::create([
        'title' => 'Test Post',
        'content' => 'Test content',
    ]);

    $this->actingAs($admin)
        ->get(route('admin'))
        ->assertSuccessful();

    $this->actingAs($admin)
        ->get(route('posts.edit', $post))
        ->assertSuccessful();
});
