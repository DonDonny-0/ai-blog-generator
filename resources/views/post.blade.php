<x-layout>
  <h1>{{ $post->title }}</h1>

  <p>{!! nl2br(e($post->content)) !!}</p>
</x-layout>