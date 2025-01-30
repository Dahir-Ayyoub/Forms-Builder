
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="">
    {{-- <nav class="bg-white shadow-md py-4">
        <div class="container mx-auto flex items-center justify-between px-6">
            <a class="text-xl font-bold text-gray-800 hover:text-blue-600" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>

            <div class="flex items-center">
                <ul class="hidden md:flex space-x-6">
                    <!-- Left Side Of Navbar -->
                     @auth
                        @if(auth()->user()->hasRole('admin'))
                            <li>
                                <a class="text-gray-700 hover:text-blue-500" href="{{ route('show-roles') }}">Show Roles</a>
                            </li>
                            <li>
                                <a class="text-gray-700 hover:text-blue-500" href="{{ route('forms.index') }}">Show Forms</a>
                            </li>
                        @endif
                     @endauth
                </ul>

                <ul class="hidden md:flex space-x-6 items-center">
                    <!-- Right Side Of Navbar -->
                    @guest
                        @if (Route::has('login'))
                            <li><a class="text-gray-700 hover:text-blue-500" href="{{ route('login') }}">Login</a></li>
                        @endif
                        @if (Route::has('register'))
                            <li><a class="text-gray-700 hover:text-blue-500" href="{{ route('register') }}">Register</a></li>
                        @endif
                    @else
                        <li class="relative">
                            <button id="navbarDropdown" class="text-gray-700 hover:text-blue-500 focus:outline-none flex items-center space-x-2" data-dropdown-toggle="userDropdown" type="button">
                                <span class="font-medium">{{ Auth::user()->name }}</span>
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </button>
                            <div id="userDropdown" class="absolute hidden bg-white shadow-md mt-2 py-2 w-48 right-0 rounded z-10" aria-labelledby="navbarDropdown">
                                <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
                                <div class="md:hidden flex items-center">
                    <button onclick="toggleMobileMenu()" id="mobile-menu-button" class="focus:outline-none">
                        <svg class="h-6 w-6 fill-current text-gray-600" viewBox="0 0 24 24">
                             <path id="open" class="visible"  fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z" clip-rule="evenodd"/>
                             <path id="close" class="hidden"  fill-rule="evenodd" d="M6 6l12 12m-6-12l6 12" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>


            </div>

               <div id="mobile-menu" class="hidden md:hidden absolute top-full right-0 w-full bg-white shadow-md py-2 z-20">
                       <ul class="block">
                        @auth
                        @if(auth()->user()->hasRole('admin'))
                           <li>
                                <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('show-roles') }}">Show Roles</a>
                             </li>
                           <li>
                                <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('forms.index') }}">Show Forms</a>
                            </li>
                        @endif
                        @endauth

                        @guest
                            @if (Route::has('login'))
                                 <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('login') }}">Login</a></li>
                            @endif
                            @if (Route::has('register'))
                                <li><a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('register') }}">Register</a></li>
                            @endif
                        @else
                            <li>
                                    <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form-mobile').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                             </li>

                        @endguest
                    </ul>
              </div>

        </div>

    </nav> --}}
    @include('partials.nav');
    <main class="py-4">
        <div class="container mx-auto px-6">
           @yield('content')
        </div>
    </main>

 <script>

function toggleMobileMenu() {
     const mobileMenu = document.getElementById('mobile-menu');
     const openBtn = document.getElementById('open');
     const closeBtn = document.getElementById('close');
    mobileMenu.classList.toggle('hidden');
    openBtn.classList.toggle('hidden');
    closeBtn.classList.toggle('hidden');
}

//Dropdown function
document.addEventListener('DOMContentLoaded', function () {
    const dropdownButton = document.getElementById('navbarDropdown');
    const dropdownMenu = document.getElementById('userDropdown');

    if (dropdownButton && dropdownMenu) {
        dropdownButton.addEventListener('click', function() {
            dropdownMenu.classList.toggle('hidden');
        });

    // Close the dropdown if clicking outside
            document.addEventListener('click', function(event) {
                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
       }

});
</script>

</body>
</html>











{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                    testing
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

 <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
 --}}



 