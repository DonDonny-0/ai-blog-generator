<x-layout>
    <div class="bg-gray-300 mt-16 rounded-xl relative w-2/5 mx-auto text-gray-500">
        <form action="/signup" method="POST" class="flex flex-col text-left mx-auto w-9/10 max-w-lg">
            @csrf
            <div class="pt-8">
                <h1 class="text-2xl">Create an Account</h1>
            </div>

            <label for="name" class="mt-4">Name<span class="text-red-500 ml-2">*</span></label>
            <input type="text" id="name" name="name" class="bg-white/60 mt-2 rounded-full p-2">

            <label for="email" class="mt-4">Email<span class="text-red-500 ml-2">*</span></label>
            <input type="text" id="email" name="email" class="bg-white/60 mt-2 rounded-full p-2">

            <label for="password" class="mt-4">Password<span class="text-red-500 ml-2">*</span></label>
            <input type="password" id="password" name="password" class="bg-white/60 mt-2 rounded-full p-2">

            <div class="flex flex-row justify-between pt-4 my-5 items-center">
                <div class="pb-6 pl-1">
                    {{-- <x-errors name="password" /> --}}
                </div>
                <button type="submit" class="border p-2 rounded-full w-20 text-gray-700 bg-gray-300 hover:bg-gray-300/70 cursor-pointer">Log In</button>
            </div>
        </form>
    </div>
</x-layout>