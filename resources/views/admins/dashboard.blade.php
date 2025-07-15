<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Sidebar Tailwind</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #4B5563;
        border-radius: 3px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #1F2937;
    }
</style>

<body class="bg-gray-100">

    <div x-data="{ open: true, submenu: null }" class="flex h-screen">

        <!-- Sidebar -->
        <aside :class="open ? 'w-64' : 'w-20'"
            class="bg-gray-800 text-white transition-all duration-300 relative flex flex-col">

            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-700 flex-shrink-0">
                <span x-show="open" class="text-xl font-semibold">Navigation</span>
                <button @click="open = !open" class="p-2 rounded hover:bg-gray-700">
                    <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Navigation - Scrollable Area -->
            <nav class="flex-1 overflow-y-auto custom-scrollbar">
                <ul class="space-y-1 pb-16">
                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('dashboarHome') }}" class="flex items-center p-4 hover:bg-gray-700">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span x-show="open" class="ml-4">Dashboard</span>
                        </a>
                    </li>

                    <!-- Open trip with submenu -->
                    <li>
                        <button @click="submenu === 'opentrip' ? submenu = null : submenu = 'opentrip'"
                            class="flex items-center w-full p-4 hover:bg-gray-700 focus:outline-none">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                            </svg>
                            <span x-show="open" class="ml-4 flex-1 text-left">Open Trip</span>
                            <svg x-show="open" :class="submenu === 'opentrip' ? 'transform rotate-180' : ''"
                                class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open && submenu === 'opentrip'" class="bg-gray-900">
                            <a href="{{ route('openTrip') }}"
                                class="block pl-14 pr-4 py-2 hover:bg-gray-600 border-b border-gray-800">
                                Open Trip Page
                            </a>
                            <a href="{{ route('tripSchedule') }}"
                                class="block pl-14 pr-4 py-2 hover:bg-gray-600 border-b border-gray-800">
                                Trip Schedule
                            </a>
                            <a href="{{ route('tripDestination') }}"
                                class="block pl-14 pr-4 py-2 hover:bg-gray-600 border-b border-gray-800">
                                Trip Destinantion
                            </a>
                            <a href="{{ route('tripItineraries') }}"
                                class="block pl-14 pr-4 py-2 hover:bg-gray-600 border-b border-gray-800">
                                Trip Itineraries
                            </a>
                        </div>
                    </li>

                    <!-- Rental Item with submenu -->
                    <li>
                        <button @click="submenu === 'rentalitem' ? submenu = null : submenu = 'rentalitem'"
                            class="flex items-center w-full p-4 hover:bg-gray-700 focus:outline-none">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path
                                    d="M12 21L20.131 16.792c.316-.164.474-.245.589-.366a1 1 0 0 0 .226-.373c.054-.159.054-.336.054-.692V7.533M12 21L3.869 16.792c-.316-.164-.474-.245-.589-.366a1.009 1.009 0 0 1-.226-.373C3 15.894 3 15.716 3 15.359V7.533M12 21v-9.063m9-4.404l-9 4.404m9-4.404L12.73 2.849c-.267-.138-.4-.208-.541-.235a.994.994 0 0 0-.378 0c-.14.027-.274.097-.542.235L3 7.533m0 0l9 4.404" />
                            </svg>
                            <span x-show="open" class="ml-4 flex-1 text-left">Rental Item</span>
                            <svg x-show="open" :class="submenu === 'rentalitem' ? 'transform rotate-180' : ''"
                                class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open && submenu === 'rentalitem'" class="bg-gray-900">
                            <a href="{{ route('itemRental') }}" class="block pl-14 pr-4 py-2 hover:bg-gray-700">
                                Item Rental
                            </a>
                        </div>
                    </li>

                    <!-- order Item with submenu -->
                    <li>
                        <button @click="submenu === 'order' ? submenu = null : submenu = 'order'"
                            class="flex items-center w-full p-4 hover:bg-gray-700 focus:outline-none">
                            <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                            </svg>
                            <span x-show="open" class="ml-4 flex-1 text-left">Order</span>
                            <svg x-show="open" :class="submenu === 'order' ? 'transform rotate-180' : ''"
                                class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open && submenu === 'order'" class="bg-gray-900">
                            <a href="{{ route('tripOrder') }}"
                                class="block pl-14 pr-4 py-2 hover:bg-gray-600 border-b border-gray-800">
                                Trip Order
                            </a>
                            <a href="{{ route('rentalOrder') }}"
                                class="block pl-14 pr-4 py-2 hover:bg-gray-600 border-b border-gray-800">
                                Rental Order
                            </a>
                        </div>
                    </li>

                    <!-- reviews Item with submenu -->
                    <li>
                        <button @click="submenu === 'review' ? submenu = null : submenu = 'review'"
                            class="flex items-center w-full p-4 hover:bg-gray-700 focus:outline-none">
                            <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                            </svg>
                            <span x-show="open" class="ml-4 flex-1 text-left">Review</span>
                            <svg x-show="open" :class="submenu === 'review' ? 'transform rotate-180' : ''"
                                class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open && submenu === 'review'" class="bg-gray-900">
                            <a href="{{ route('tripReviews') }}"
                                class="block pl-14 pr-4 py-2 hover:bg-gray-600 border-b border-gray-800">
                                Trip Reviews
                            </a>
                            <a href="{{ route('rentalReviews') }}"
                                class="block pl-14 pr-4 py-2 hover:bg-gray-600 border-b border-gray-800">
                                Rental Reviews
                            </a>
                        </div>
                    </li>

                    <!-- Settings with submenu -->
                    <li>
                        <button @click="submenu === 'settings' ? submenu = null : submenu = 'settings'"
                            class="flex items-center w-full p-4 hover:bg-gray-700 focus:outline-none">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span x-show="open" class="ml-4 flex-1 text-left">Settings</span>
                            <svg x-show="open" :class="submenu === 'settings' ? 'transform rotate-180' : ''"
                                class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open && submenu === 'settings'" class="bg-gray-900">
                            <a href="#"
                                class="block pl-14 pr-4 py-2 hover:bg-gray-600 border-b border-gray-800">General</a>
                            <a href="#" class="block pl-14 pr-4 py-2 hover:bg-gray-700">Privacy</a>
                        </div>
                    </li>

                    <!-- Notifications -->
                    <li>
                        <a href="#" class="flex items-center p-4 hover:bg-gray-700">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span x-show="open" class="ml-4">Notifications</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Footer - Fixed at bottom with solid background -->
            <div class="bg-gray-800 border-t border-gray-700 flex-shrink-0">
                <!-- User Info -->
                <div class="flex items-center p-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <div class="flex flex-col space-y-1 ml-3" x-show="open">
                        <span class="text-sm font-semibold text-white">{{ Auth::user()->name }}</span>
                        <span class="text-xs text-red-500">{{ Auth::user()->role }}</span>
                    </div>
                </div>

                <!-- Logout Button -->
                <div class="border-t border-gray-700">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center w-full p-4 hover:bg-red-600 text-left transition-colors duration-200">
                            <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span x-show="open" class="ml-4 text-red-400">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>


        <!-- Main Content -->
        <main class="flex-1 p-6 bg-white overflow-y-auto">
            @yield('content')
        </main>

    </div>

</body>

</html>
