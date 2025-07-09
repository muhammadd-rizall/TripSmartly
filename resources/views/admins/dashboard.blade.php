<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Sidebar Tailwind</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100">

    <div x-data="{ open: true, submenu: null }" class="flex h-screen">

        <!-- Sidebar -->
        <aside :class="open ? 'w-64' : 'w-20'" class="bg-gray-800 text-white transition-all duration-300 relative">

            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-700">
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

            <!-- Navigation -->
            <nav class="mt-4">
                <ul class="space-y-1">
                    <!-- Dashboard -->
                    <li>
                        <a href="#" class="flex items-center p-4 hover:bg-gray-700">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    strokeWidth={1.5} stroke="currentColor" className="size-6">
                                    <path strokeLinecap="round" strokeLinejoin="round"
                                        d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>

                            </svg>
                            <span x-show="open" class="ml-4">Dashboard</span>
                        </a>
                    </li>

                    <!-- Open trip with submenu -->
                    <li>
                        <button @click="submenu === 'opentrip' ? submenu = null : submenu = 'opentrip'"
                            class="flex items-center w-full p-4 hover:bg-gray-700 focus:outline-none">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    strokeWidth={1.5} stroke="currentColor" className="size-6">
                                    <path strokeLinecap="round" strokeLinejoin="round"
                                        d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                                </svg>

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
                            <a href="{{ route('openTrip') }}" class="block pl-14 pr-4 py-2 hover:bg-gray-700">
                                Open Trip Page
                            </a>
                            <a href="{{ route('tripSchedule') }}" class="block pl-14 pr-4 py-2 hover:bg-gray-700">
                                Trip Schedule
                            </a>
                            <a href="{{ route('tripDestination') }}" class="block pl-14 pr-4 py-2 hover:bg-gray-700">
                                Trip Destinantion
                            </a>
                            <a href="{{ route('tripItineraries') }}" class="block pl-14 pr-4 py-2 hover:bg-gray-700">
                                Trip Itineraries
                            </a>
                        </div>

                    </li>

                    <!-- Rental Item with submenu -->
                    <li>
                        <button @click="submenu === 'rentalitem' ? submenu = null : submenu = 'rentalitem'"
                            class="flex items-center w-full p-4 hover:bg-gray-700 focus:outline-none">

                            <!-- Icon box (dari heroicons / lucide) -->
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path
                                    d="M12 21L20.131 16.792c.316-.164.474-.245.589-.366a1 1 0 0 0 .226-.373c.054-.159.054-.336.054-.692V7.533M12 21L3.869 16.792c-.316-.164-.474-.245-.589-.366a1.009 1.009 0 0 1-.226-.373C3 15.894 3 15.716 3 15.359V7.533M12 21v-9.063m9-4.404l-9 4.404m9-4.404L12.73 2.849c-.267-.138-.4-.208-.541-.235a.994.994 0 0 0-.378 0c-.14.027-.274.097-.542.235L3 7.533m0 0l9 4.404" />
                            </svg>

                            <!-- Label -->
                            <span x-show="open" class="ml-4 flex-1 text-left">Rental Item</span>

                            <!-- Chevron icon -->
                            <svg x-show="open" :class="submenu === 'rentalitem' ? 'transform rotate-180' : ''"
                                class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Submenu -->
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

                            <!-- Icon box (dari heroicons / lucide) -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                              </svg>


                            <!-- Label -->
                            <span x-show="open" class="ml-4 flex-1 text-left">Order</span>

                            <!-- Chevron icon -->
                            <svg x-show="open" :class="submenu === 'order' ? 'transform rotate-180' : ''"
                            class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7" />
                        </svg>

                        </button>

                        <!-- Submenu -->
                        <div x-show="open && submenu === 'order'" class="bg-gray-900">
                            <a href="{{ route('tripOrder') }}" class="block pl-14 pr-4 py-2 hover:bg-gray-700">
                                Trip Order
                            </a>
                            <a href="{{ route('rentalOrder') }}" class="block pl-14 pr-4 py-2 hover:bg-gray-700">
                                Rental Order
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
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
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
                            <a href="#" class="block pl-14 pr-4 py-2 hover:bg-gray-700">General</a>
                            <a href="#" class="block pl-14 pr-4 py-2 hover:bg-gray-700">Privacy</a>
                        </div>
                    </li>

                    <!-- Other items -->
                    <li>
                        <a href="#" class="flex items-center p-4 hover:bg-gray-700">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 11V7a4 4 0 018 0v4" />
                            </svg>
                            <span x-show="open" class="ml-4">Analytics</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="flex items-center p-4 hover:bg-gray-700">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2m-4 0H7a2 2 0 01-2-2V10a2 2 0 012-2h6m4 0V6a2 2 0 00-2-2H7a2 2 0 00-2 2v2" />
                            </svg>
                            <span x-show="open" class="ml-4">Messages</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="flex items-center p-4 hover:bg-gray-700">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405M4 4l16 16" />
                            </svg>
                            <span x-show="open" class="ml-4">Notifications</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Footer -->
            <div class="absolute bottom-0 w-full border-t border-gray-700">
                <a href="#" class="flex items-center p-4 hover:bg-gray-700">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A7 7 0 1116.95 6.05a7 7 0 01-11.829 11.754z" />
                    </svg>
                    <span x-show="open" class="ml-4">User Profile</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 bg-white overflow-y-auto">
            @yield('content')
        </main>



    </div>

</body>

</html>
