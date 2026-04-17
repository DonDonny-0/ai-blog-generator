<x-layout>

  <form method="POST" action="{{ route('generate.post') }}" class="flex items-center flex-col mt-50 bg-gray-300 w-3/5 mx-auto rounded-xl p-10">
      @csrf

      <label class="text-2xl font-bold">Enter a blog topic or keywords</label>
      <input type="text" name="prompt" class="p-2 bg-white/60 text-gray-500 rounded-full mt-2 w-3/5" required><br>

      <div>
        <a class="mr-4 p-2 px-4 border rounded-full font-bold w-30 text-center" href="{{ route('posts.index') }}">Back</a>

        <button type="submit" class="text-blue-600 font-bold mr-4 p-2 border rounded-full w-60 bg-blue-400 hover:bg-blue-400/40 text-center cursor-pointer">Generate Post</button>
      </div>
  </form>

</x-layout>