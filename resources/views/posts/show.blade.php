<x-layout>

  <div class="w-4/5 mx-auto flex mt-12">
    <a href="{{ route('posts.index') }}" class="cursor-pointer font-bold w-20 p-2 text-center border rounded-full">Back</a>
    @can('manage-posts')
      <a href="{{ route('posts.edit', $post) }}" class="ml-4 p-2 border rounded-full w-17 text-blue-500 font-bold text-center">Edit</a>
    @endcan
  </div>

  <div class="p-5 w-4/5 mx-auto border rounded-xl mt-12 bg-gray-300 text-gray-500">
    <img src="http://picsum.photos/1350/600" alt="" class="rounded-lg">
    <div class="prose prose-gray max-w-none mt-6">
      {!! $htmlContent !!}
    </div>
  </div>

  <div class="w-4/5 mx-auto mb-30">
    <h3 class="mt-8 font-semibold">Leave a Comment</h3>

    @auth
      <form method="POST" action="{{ route('comments.store', $post) }}">
          @csrf

          <input type="text" name="website" class="hidden">

          <div class="mt-4">
              {{-- <label class="block">Email</label> --}}
              <input type="email" value="{{ auth()->user()->email }}" disabled class="border w-full bg-gray-100 text-gray-600 hidden">
          </div>

          <div class="mt-4">
              {{-- <label class="block">Comment</label> --}}
              <textarea name="content" required class="border text-gray-600 w-full rounded-md h-30 bg-gray-200">{{ old('content') }}</textarea>
              @error('content')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
              @enderror
          </div>

          <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2">
              Post Comment
          </button>
      </form>
    @else
      <p class="mt-4">Please <a href="{{ route('login') }}" class="font-bold underline">log in</a> to post a comment.</p>
    @endauth

    <h2 class="mt-10 text-xl font-bold">Comments</h2>

    @forelse ($post->comments as $comment)
        <div class="border-b py-4">
            <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($comment->email))) }}">
            <p class="text-sm text-gray-600">
                {{ $comment->email }}
            </p>

            <p>{{ $comment->content }}</p>
        </div>
    @empty
        <p class="mt-4 text-gray-600">No comments yet.</p>
    @endforelse
  </div>

</x-layout>
