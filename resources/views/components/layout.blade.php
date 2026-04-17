<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NM Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="text-gray-200 bg-gray-400">
    <header class="bg-gray-500 py-5 ">
        <div class="rounded-b-sm flex justify-between items-center w-9/10 mx-auto">
            <div class="flex items-center justify-between w-60">
                <img src="{{ asset('img/user.png') }}" alt="" class="h-10">
                <h1 class="text-xl font-bold">FoodCultures</h1>
            </div>
            <div class="relative">
                <x-nav />
            </div>
        </div>
    </header>
    <main class="flex flex-col text-white w-9/10 mx-auto relative">
      {{ $slot }}
    </main>
</body>
</html>
