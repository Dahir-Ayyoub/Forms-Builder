<script src="https://unpkg.com/@tailwindcss/browser@4"></script>

<nav class="bg-white border-b border-gray-100">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo Section -->
            <div class="flex items-center flex-shrink-0">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('logo.png') }}" alt="HiZi Mark Pro Logo" class="h-8 w-auto transition-transform hover:scale-105" />
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex md:items-center md:space-x-8">
                <!-- Admin Links -->
                @auth
                    @if(auth()->user()->hasRole('admin'))
                        <div class="flex space-x-4">
                            <a href="{{ route('show-roles') }}" 
                               class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-green-500 hover:bg-green-50 rounded-lg transition-all duration-200 no-underline">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Show Roles
                            </a>
                            <a href="{{ route('forms.index') }}" 
                               class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-green-500 hover:bg-green-50 rounded-lg transition-all duration-200 no-underline">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Show Forms
                            </a>
                        </div>
                    @endif
                @endauth

                <!-- Auth Links -->
                <div class="flex items-center space-x-4">
                    @guest
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" 
                               class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-green-500 hover:bg-green-50 rounded-lg transition-all duration-200 no-underline">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                </svg>
                                Login
                            </a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-500 hover:bg-green-600 rounded-lg transition-all duration-200 no-underline">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                </svg>
                                Register
                            </a>
                        @endif
                    @else
                        {{-- <div class="flex items-center space-x-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span class="text-blue-500 font-medium">{{ Auth::user()->name }}</span>
                            </div>
                            <a href="{{ route('logout') }}"
						onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
						class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-500 hover:text-white hover:bg-red-500 rounded-lg transition-all duration-200 no-underline">
							<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
							</svg>
						Logout
							</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div> --}}
						<div class="flex items-center space-x-4">
							<div class="flex items-center">
								<svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
								</svg>
								<span class="text-blue-500 font-medium">{{ Auth::user()->name }}</span>
							</div>
							<a href="{{ route('logout') }}"
							   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
							   class="inline-flex items-center mx-3 px-4 py-2 text-sm font-medium text-white bg-red-500 hover:bg-red-600 rounded-lg transition-all duration-200 no-underline">
								<svg class="w-4 h-4 mr-2" fill="none" stroke="white" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
								</svg>
								Logout
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
								@csrf
							</form>
						</div>
                    @endguest
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button type="button" 
                        onclick="toggleMobileMenu()"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-green-500 hover:bg-green-50 transition-colors duration-200">
                    <svg id="menu-open" class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg id="menu-close" class="hidden h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden md:hidden border-t border-gray-100">
        <div class="px-2 pt-2 pb-3 space-y-1">
            @auth
                @if(auth()->user()->hasRole('admin'))
                    <a href="{{ route('show-roles') }}" 
                       class="flex items-center px-4 py-2 text-base font-medium text-gray-700 hover:text-green-500 hover:bg-green-50 rounded-lg transition-all duration-200 no-underline">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Show Roles
                    </a>
                    <a href="{{ route('forms.index') }}" 
                       class="flex items-center px-4 py-2 text-base font-medium text-gray-700 hover:text-green-500 hover:bg-green-50 rounded-lg transition-all duration-200 no-underline">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Show Forms
                    </a>
                @endif
            @endauth

            @guest
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" 
                       class="flex items-center px-4 py-2 text-base font-medium text-gray-700 hover:text-green-500 hover:bg-green-50 rounded-lg transition-all duration-200 no-underline">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Login
                    </a>
                @endif
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" 
                       class="flex items-center px-4 py-2 text-base font-medium text-gray-700 hover:text-green-500 hover:bg-green-50 rounded-lg transition-all duration-200 no-underline">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Register
                    </a>
                @endif
            @else
                <div class="px-4 py-2">
                    <div class="flex items-center text-red-500 font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        {{ Auth::user()->name }}
                    </div>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                       class="mt-1 flex items-center px-4 py-2 text-base font-medium text-gray-700 hover:text-green-500 hover:bg-green-50 rounded-lg transition-all duration-200 no-underline">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </a>
                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            @endguest
        </div>
    </div>
</nav>

<script>
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobile-menu');
    const menuOpen = document.getElementById('menu-open');
    const menuClose = document.getElementById('menu-close');
    
    mobileMenu.classList.toggle('hidden');
    menuOpen.classList.toggle('hidden');
    menuClose.classList.toggle('hidden');
    
    if (!mobileMenu.classList.contains('hidden')) {
        mobileMenu.classList.add('animate-slide-in');
    } else {
        mobileMenu.classList.remove('animate-slide-in');
    }
}

const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from { transform: translateY(-100%); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    .animate-slide-in {
        animation: slideIn 0.2s ease-out;
    }
    a { text-decoration: none !important; }
`;
document.head.appendChild(style);
</script>









{{-- <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <nav class="bg-white shadow-md py-4">
        <div class="container mx-auto flex items-center justify-between px-6">
			<a href="/" class="block">
				<img src="{{ asset('logo.png') }}" alt="HiZi Mark Pro Logo" class="h-8" />
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

    </nav>

 <script>
   function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            const open = document.getElementById('open');
             const close = document.getElementById('close');

            mobileMenu.classList.toggle('hidden');
            open.classList.toggle('hidden');
            close.classList.toggle('hidden')

        }
    </script> --}}

