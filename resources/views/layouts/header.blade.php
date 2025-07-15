<header class="flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-white shadow text-sm py-3 fixed top-0 z-50">
    <nav class="max-w-[85rem] w-full mx-auto px-4 flex flex-wrap basis-full items-center justify-between">

        <!-- Logo -->
        <a class="sm:order-1 flex-none text-xl font-bold text-blue-500 hover:text-yellow-400 transition" href="/">
            TRIp Smartly
        </a>

        <!-- Mobile Toggle Button -->
        <button type="button"
            class="sm:hidden hs-collapse-toggle relative size-9 flex justify-center items-center gap-x-2 rounded-lg border border-blue-500/50 bg-blue-500/20 text-blue-500 hover:bg-blue-500/40 hover:text-yellow-400 transition focus:outline-none"
            id="hs-navbar-alignment-collapse" aria-expanded="false" aria-controls="hs-navbar-alignment"
            aria-label="Toggle navigation" data-hs-collapse="#hs-navbar-alignment">
            <!-- Icon Open -->
            <svg class="hs-collapse-open:hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <line x1="3" x2="21" y1="6" y2="6" />
                <line x1="3" x2="21" y1="12" y2="12" />
                <line x1="3" x2="21" y1="18" y2="18" />
            </svg>
            <!-- Icon Close -->
            <svg class="hs-collapse-open:block hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M18 6 6 18" />
                <path d="m6 6 12 12" />
            </svg>
            <span class="sr-only">Toggle</span>
        </button>

        <!-- Mobile / Desktop Navigation Links -->
        <div id="hs-navbar-alignment"
            class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:grow-0 sm:basis-auto sm:block sm:order-2"
            aria-labelledby="hs-navbar-alignment-collapse">
            <div class="flex flex-col gap-5 mt-5 sm:flex-row sm:items-center sm:mt-0 sm:ps-5">
                <a class="font-bold text-blue-500 hover:text-yellow-400 transition" href="/">Home</a>
                <a class="font-bold text-blue-500 hover:text-yellow-400 transition" href="{{ route('tripViews') }}">Open Trip</a>
                <a class="font-bold text-blue-500 hover:text-yellow-400 transition" href="{{ route('rentalViews') }}">Rental Barang</a>
                @auth
                    <a class="font-bold text-blue-500 hover:text-yellow-400 transition" href="{{ route('historiOrder') }}">History Order</a>
                @endauth
            </div>
        </div>

        <!-- Login / Logout -->
        <div class="sm:order-3 flex items-center gap-x-2">
            @guest
                <!-- Tombol Login untuk tamu -->
                <a href="{{ route('login') }}">
                    <button type="button"
                        class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-blue-500 text-white hover:bg-yellow-400 hover:text-black transition">
                        Login
                    </button>
                </a>
            @else
                <!-- Jika sudah login -->
                <span class="hidden sm:inline text-sm text-gray-700">Hi, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-red-500 text-white hover:bg-yellow-400 hover:text-black transition">
                        Logout
                    </button>
                </form>
            @endguest
        </div>
    </nav>
</header>
