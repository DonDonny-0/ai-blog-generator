<x-layout>
    <div class="text-center mt-12">
        <h1 class="text-2xl font-bold">Our Latest Updates</h1>

        @can('manage-posts')
            <a href="{{ route('admin') }}" class="block w-1/4 mx-auto mt-6 p-2 border rounded-full">Create Post</a>
        @endcan

        @if($posts->isEmpty())
            <p class="mt-12">No posts yet.</p>
        @endif

        <div class="grid grid-cols-3 my-12 gap-10">
            @foreach ($posts as $post)
                <div class="bg-gray-300 rounded-xl flex flex-col p-4 text-left text-gray-500/80">
                    <div>
                        <img src="http://picsum.photos/550/400" alt="" class="rounded-lg">
                    </div>
                    <div class="flex flex-col mt-2">
                        <h1 class="font-bold text-gray-800">
                            <a href="{{ route('posts.show', $post) }}" class="hover:underline">
                                {{ $post->title }}
                            </a>
                        </h2><br>
                        <p class="text-lg">{{ \Illuminate\Support\Str::limit($post->content, 240) }}</p>
                        @can('manage-posts')
                            <div class="flex justify-end mt-6">
                                <a class="text-blue-500 font-bold mr-4 p-2 border rounded-full w-17 text-center" href="{{ route('posts.edit', $post) }}">Edit</a>

                                <form class="text-red-700" method="POST" action="{{ route('posts.destroy', $post) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('delete this post')" class="cursor-pointer font-bold w-20 p-2 border rounded-full">Delete</button>
                                </form>
                            </div>
                        @endcan
                    </div>
                </div>
            @endforeach
        </div>

        {{ $posts->links() }}
    </div>
</x-layout>

 {{-- href="{{ route('posts.show', $post) }}" --}}
