<?php

namespace App\Http\Controllers;

use League\CommonMark\CommonMarkConverter;
use Illuminate\Http\Request;
use App\Models\Post;
use OpenAI;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function createAI()
    {
        return view('admin');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string|max:255'
        ]);

        $client = OpenAI::client(env('OPENAI_API_KEY'));

        $response = $client->responses()->create([
            'model' => 'gpt-4.1-mini',
            'input' => "Write a detailed blog post about: " . $request->prompt
        ]);

        $content = $response->output[0]->content[0]->text;

        // Optional: extract title (simple approach)
        $title = ucfirst($request->prompt);

        $post = Post::create([
            'title' => $title,
            'content' => $content
        ]);

        return redirect('/posts/' . $post->id);
    }

    public function show(Post $post)
    {
        $converter = new CommonMarkConverter();
        $post->load(['comments' => fn($q) => $q->latest()->paginate(10)]);

        $htmlContent = $converter->convert($post->content);

        return view('posts.show', [
            'post' => $post,
            'htmlContent' => $htmlContent
        ]);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post) 
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect()->route('posts.show', $post)
            ->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted');
    }
}
