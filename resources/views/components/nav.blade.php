<div class="items-center flex-row text-center space-x-6 font-bold text-xl">
    

  @guest
    <a href="/login">Login</a>
    <a href="/signup">signup</a>
  @endguest

  @auth
    <form method="POST" action="/logout">
        @csrf
        @method('DELETE')

        <button class="cursor-pointer">Logout</button>
    </form>
  @endauth
</div>