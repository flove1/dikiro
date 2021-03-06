<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('img/logo.svg') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/decorations.css') }}" rel="stylesheet">

    @yield('styles')

</head>

<body>
    <div class="navbar">
        <div class="container-fluid row justify-content-evenly">
{{--            <div id="container-choose-city" class="col-1 col-sm-5">--}}
{{--                <a class="navbar-text">Astana</a>--}}
{{--            </div>--}}
            <div class="navbar-text col-5 col-lg-3" style="cursor: pointer" onclick="window.location='/'">DIKIRO</div>
            <div class="col-7 col-lg-5 d-flex justify-content-end text-light rounded-pill">
                <!-- <form class="input-group flex-grow-1">
                    <input class="form-control rounded-pill rounded-end" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-light rounded-pill rounded-start pe-3" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form> -->
                @unless(Auth::check())
                    <button onclick="window.location.href='/register'" class="btn btn-light rounded text-nowrap px-3 py-2 me-3 fs-5">Sign up</button>
                    <button onclick="window.location.href='/login'" class="btn btn-light rounded text-nowrap px-3 py-2 fs-5">Login</button>
                @else
                <button class="btn btn-light rounded me-2 my-2 px-3 text-nowrap fs-5" onclick="window.location='/cabinet'">Profile</button>
                @if (Auth::user()->role == "admin")
                    <button class="btn btn-light rounded me-2 my-2 px-3 fs-5 text-nowrap" onclick="window.location='/vendor'">Admin page</button>
                @endif
                    <img class="rounded-circle mx-2" style="border: 2px dashed black" src="{{ asset(Auth::user()->img_path) }}"/>
                <form class="d-flex mx-2" action="/logout" method="post">
                    @csrf
                    <input class="btn btn-light rounded text-nowrap fs-5 my-2 px-3" type="submit" value="Logout">
                </form>
                @endunless
            </div>
        </div>
    </div>
    @yield('content')
    <footer class="container-fluid">
        <div class="container-lg py-3 row mx-auto justify-content-center">
            <div class="col-5">
                <h5>Have any questions?</h5>
                <div>+7 777 777 77 77</div>
                <div>+7 777 777 77 77</div>
                <div>+7 777 777 77 77</div>
            </div>
            <div class="col-4 d-block">
                <h5 >We are located:</h5>
                <div>????. ?????????? 1</div>
            </div>
            <div class="col-3">
                <h5>Games</h5>
                <div>Action</div>
                <div>Humor</div>
                <div>For 2 people</div>
                <div>For a company</div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/awesome.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>
