<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="fonts/Nunito-Fontface/stylesheet.css"> --}}
    {{-- <link rel="stylesheet" href="fonts/Roboto-Fontface/stylesheet.css"> --}}
    {{-- <link rel="stylesheet" href="css/fonts.css"> --}}
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js/jquery-ui-1.12.1/jquery-ui.css') }}">
    <script src="{{ asset('js/jquery-ui-1.12.1/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/jquery.table2excel.js') }}"></script>
    <script>
        var reloadable_page = true;
        const show_console = true;
    </script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <style>
        [x-cloak] {
            display: none;
        }
    </style>

    <title>@yield('title')</title>
</head>

<body class="relative">
    {{-- NAVBAR --}}
    <div id="nav_cart_close_layer" class="absolute top-0 bottom-0 left-0 right-0 hidden z-30" onclick="hideNavCart()"></div>
    <nav class="h-11 bg-violet-500 text-white flex justify-between items-center pl-3" x-data="{show_dd:false}">
        <div class="flex items-center">
            @if ($goback!=='')
            <a href="{{ route($goback) }}" class="text-white font-bold bg-orange-500 rounded p-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="6" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </a>
            @endif
            <a href="/" class="text-white h-11 flex items-center ml-3"
                ><span class="font-semibold text-xl">Gol D. Jewel</span></a
            >
        </div>
        <div class="flex items-center">
            @auth
            {{-- NAVBAR - CART --}}
            <div class="relative">
                <button class="bg-orange-500 text-white rounded p-1" type="button" onclick="toggleNavCart()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                </button>
                <div class="absolute -bottom-4 flex left-1/2 -translate-x-1/2">
                    @foreach ($carts_data['carts'] as $key=>$cart)
                    <div class="rounded-full w-5 h-5 bg-pink-500 flex items-center justify-center @if ($key!==0) -ml-1 @endif">
                        <span class="text-white font-bold">{{ count($cart->items) }}</span>
                    </div>
                    @endforeach
                </div>
                <div id="nav_cart" class="absolute -right-5 z-50 bg-white rounded hidden">
                    <table class="table-nice">
                        @foreach ($carts_data['carts'] as $key=>$cart)
                        <tr>
                            <td>{{ $cart->tipe_pelanggan }}</td>
                            <td>{{ $carts_data['usernames'][$key] }}</td>
                            <td>{{ $carts_data['count_items'][$key] }}</td>
                        {{-- DROPDOWN - CART --}}
                            <td>
                                <div id="dd_btn_cart-{{ $key }}" class="rounded bg-white shadow drop-shadow" onclick="showDropdownMultiple(this.id, 'dd_content_cart-{{ $key }}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </div>
                            </td>
                        </tr>
                        <tr id="dd_content_cart-{{ $key }}" class="hidden">
                            <td colspan="4">
                                <table>
                                    @foreach ($cart->items as $item)
                                    <tr>
                                        <td>{{ $item->nama }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                                <div class="flex items-center justify-end">
                                    <a href="{{ route('carts.show',$cart->id) }}" class="bg-yellow-500 text-white font-bold p-1 rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('carts.create') }}" class="m-0 ml-1">
                                        <input type="hidden" name="pelanggan_id" value="{{ $cart->pelanggan_id }}">
                                        <input type="hidden" name="guest_id" value="{{ $cart->guest_id }}">
                                        <button type="submit" class="bg-emerald-500 text-white p-1 flex items-center rounded" name="tipe_pelanggan" value="{{ $cart->tipe_pelanggan }}">
                                            <span class="font-bold">+</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endauth
            <div class="relative" @mouseover="show_dd=true" @mouseleave="show_dd=false">
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
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="flex items-center w-48 px-5 py-3 hover:bg-slate-100 rounded">
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
                            <span class="ml-1">Logout</span>
                        </button>
                        </form>
                    </li>

                    @endauth
                    @guest
                    <li>
                        <a
                            href="{{ route('login') }}"
                            class="flex items-center h-11 w-48 px-5 hover:bg-slate-100 rounded">Login</a
                        >
                    </li>

                    @endguest
                    </ul>
            </div>
        </div>
    </nav>
    {{-- END: NAVBAR --}}
    <img style='position:fixed;width:5rem;top:20%;left:50%;transform:translate(-50%,-50%);' id='loading-progress-icon' src='{{ asset('img/gear_loading-violet.gif') }}' alt=''>
    @yield('content')
    <div class="mx-8 rounded border mt-5 text-center p-3">
        @auth

        <p>User logged in!</p>
        <p>Username: {{ Auth::user()->username }}</p>

        @endauth
        @guest
        <p>User is not logged in!</p>

        @endguest
    </div>
</body>

<script>
    function showDropdown(id) {
        $selectedDiv = $("#divDetailDropdown-" + id);
        $selectedDiv.toggle(400);

        if (show_console) {
            console.log(`run dropdown! ID=${id}`);
            console.log('#divDetailDropdown:');console.log($selectedDiv);
            console.log('#divDetailDropdown.css(display):');console.log($selectedDiv.css('display'));
        }

        setTimeout(() => {
            // console.log(`$selectedDiv.css("display") = ${$selectedDiv.css("display")}`);
            if ($selectedDiv.css("display") === "block" || $selectedDiv.css("display") === "table-row") {
                $("#divDropdownIcon-" + id + " img").attr("src", "/img/icons/dropup.svg");
            } else {
                $("#divDropdownIcon-" + id + " img").attr("src", "/img/icons/dropdown.svg");
            }
        }, 450);
    }

    function showDropdownMultiple(dd_btn_id, dd_content_id) {
        $selectedDiv = $(`#${dd_content_id}`);
        // console.log($selectedDiv.css("display"));
        let dd_content = document.getElementById(dd_content_id);
        let dd_btn = document.getElementById(dd_btn_id);
        if ($selectedDiv.css("display") === "block" || $selectedDiv.css("display") === "table-row") {
            dd_btn.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
            `;
        } else {
            dd_btn.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
            </svg>
            `;
        }
        $selectedDiv.toggle(400);
    }


    document.onreadystatechange = function () {
        if (document.readyState === 'complete') {
            console.log(document.readyState);
            // document.getElementById("PreLoaderBar").style.display = "none";
            // $('#loading-progress-icon').hide(300);
            $('#loading-progress-icon').hide(500);
            $('#loading-progress-icon2').hide(500);
        }
    };

    var number_to_format_k=document.querySelectorAll('.toFormatNumberK');
    number_to_format_k.forEach(element => {
        formatNumberK(parseInt(element.textContent), element);
    });

    var number_to_format=document.querySelectorAll('.toFormatNumber');
    number_to_format.forEach(element => {
        formatNumber(parseInt(element.textContent), element);
    });
    var number_to_format=document.querySelectorAll('.toFormatCurrencyRp');
    number_to_format.forEach(element => {
        formatCurrencyRp(parseInt(element.textContent), element);
    });
    // history.pushState(null, document.title, location.href);
    // window.addEventListener('popstate', function (event)
    // {
    // history.pushState(null, document.title, location.href);
    // });
</script>

</html>
