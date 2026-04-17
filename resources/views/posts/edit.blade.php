<x-layout>

  <h1 class="mt-12 text-2xl">Edit Post</h1>

  <form method="POST" action="{{ route('posts.update', $post) }}" class="flex flex-col mt-12">
      @csrf
      @method('PUT')

      <label>Title</label>
      <input type="text" name="title" value="{{ $post->title }}" class="p-2 bg-gray-300 text-gray-500 rounded-xl mt-2">

      <label class="mt-6">Content</label>
      <textarea name="content" rows="10" class="mt-2 bg-gray-300 text-gray-500 rounded-xl p-2">{{ $post->content }}</textarea><br>

      <div class="flex justify-end items-center">
        <a class="mr-4 p-2 border rounded-full w-17 text-center" href="{{ route('posts.index') }}">Back</a>
        <button class="cursor-pointer w-20 p-2 bg-gray-500 hover:bg-gray-500/70 border text-green-500 rounded-full" type="submit">Update</button>
      </div>
  </form>

</x-layout>