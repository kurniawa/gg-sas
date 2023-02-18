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
    @livewireStyles
    <title>@yield('title')</title>
</head>

<body>
    <img style='position:fixed;width:5rem;top:20%;left:50%;transform:translate(-50%,-50%);' id='loading-progress-icon' src='{{ asset('img/gear_loading-violet.gif') }}' alt=''>
    {{-- @yield('content') --}}
    {{ $slot }}
    <x-user-status></x-user-status>
    @livewireScripts
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
