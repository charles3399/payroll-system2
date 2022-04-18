<nav class="px-3 py-4 mb-5 text-white">
    <div class="flex flex-wrap justify-between items-center mx-auto">
        <div class="flex justify-start items-end">
            <a href="{{ route('welcome') }}" class="inline-flex">
                <img src="https://img.icons8.com/dusk/32/000000/payroll.png"/>
                <span class="text-sm xl:text-xl lg:text-lg md:text-md self-center tracking-wider font-bold">&nbsp;LaraPayroll</span>
            </a>
        </div>
        <div class="flex justify-end items-center">
            @auth
                <a href="{{ route('dashboard') }}" class="mx-2">Dashboard</a>
            @endauth
            @guest
                @if (Route::has('login'))
                    <div class="flex justify-start">
                        <a href="{{ route('login') }}" class="mx-2 tracking-wide">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="mx-2 tracking-wide">Register</a>
                        @endif
                    </div>
                @endif
            @else
                <div class="dropdown inline-block relative">
                    <button class="text-white text-sm mx-2 tracking-wide inline-flex justify-center">{{ Auth::user()->name }} <svg class="ml-1 w-4 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
                    <div class="hidden absolute dropdown-menu px-3 py-2 rounded-lg bg-gray-200 text-gray-700">
                        <a href="{{ route('logout') }}" class="text-sm font-bold tracking-wider" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>
            @endguest
        </div>
    </div>
</nav>