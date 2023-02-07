<div>
    <!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->
    <div class="mx-8 rounded border mt-5 text-center p-3">
        @auth

        <p>User logged in!</p>
        <p>Username: {{ Auth::user()->username }}</p>

        @endauth
        @guest
        <p>User is not logged in!</p>

        @endguest
    </div>
</div>
