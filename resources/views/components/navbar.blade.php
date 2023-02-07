<div>
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
    <nav class="h-11 bg-violet-500 text-white flex justify-between pl-5" x-data="{show_dd:false}">
        <a href="/" class="text-white h-11 flex items-center"
            ><span class="font-semibold text-xl">Gol D. Jewel</span></a
        >
        <div class="relative"
        {{-- x-on:click="show_dd=!show_dd"  --}}
        @mouseover="show_dd=true" @mouseleave="show_dd=false">
            <div class="h-11 flex items-center px-2">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="white"
                    viewBox="0 0 24 24"
                    stroke-width="3"
                    stroke="currentColor"
                    class="w-8 h-8 text-white cursor-pointer"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z"
                    />
                </svg>
            </div>
                <ul
                    class="absolute top-9 right-2 w-48 bg-white text-slate-700 rounded shadow drop-shadow z-50" x-show="show_dd"
                >
                @auth
                @if (Auth::user()->is_admin)
                <li>
                    <a
                        href="/register"
                        class="flex items-center h-11 w-48 px-5 hover:bg-slate-100 rounded-t"
                        >Register New User</a
                    >
                </li>

                @endif
                <li>
                    <form action="{{ route('Logout') }}" method="post" class="m-0">
                    @csrf
                    <button class="flex items-center w-48 px-5 py-3 hover:bg-slate-100 rounded">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"
                            />
                        </svg>
                        <span class="ml-1">Logout</span></button>
                    </form>
                </li>

                @endauth
                @guest
                <li>
                    <a
                        href="/login"
                        class="flex items-center h-11 w-48 px-5 hover:bg-slate-100 rounded">Login</a
                    >
                </li>

                @endguest
                </ul>
        </div>
    </nav>
</div>
