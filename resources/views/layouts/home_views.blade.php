@extends('layouts.landing_page')
@section('content')
    {{-- Categories --}}
    <div class="max-w-6xl mx-auto p-4 mt-8">
        <div class="inline-block">
            <div class="text-left mb-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Trip Categories</h1>
                <div class="h-1 bg-blue-500 rounded-full w-full"></div>
            </div>
        </div>
        <div class="grid gap-4 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-8">
            @forelse ($categories as $category)
                <div class="rounded-2xl overflow-hidden shadow-lg relative group">
                    <div class="relative">
                        <img src="{{ $category->image }}" alt="{{ $category->name }}"
                            class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute bottom-0 left-0 w-full bg-black/30 text-white p-2 text-center">
                            <h2 class="text-sm font-semibold truncate">{{ $category->name }}</h2>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">No categories found.</p>
            @endforelse
        </div>
    </div>

    {{-- Open Trips --}}
    <div class="max-w-6xl mx-auto p-4 mt-20">
        <div class="text-left mb-8">
            <div class="inline-block">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Trip Populer</h1>
                <div class="h-1 bg-blue-500 rounded-full w-full"></div>
            </div>
        </div>

        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ">
            {{-- Loop through open trips --}}
            @forelse ($openTrips as $openTrip)
                <div
                    class="bg-white rounded-2xl shadow-lg overflow-hidden hover:scale-102 transition-transform duration-300 max-w-f">
                    {{-- Trip Image --}}
                    <img src="{{ $openTrip->rizal_trip->image }}" alt="{{ $openTrip->rizal_trip->title }}"
                        class="w-full h-60 object-cover">

                    <div class="p-4 space-y-3">
                        <h2 class="text-lg font-bold text-gray-800 truncate">
                            {{ $openTrip->rizal_trip->title }}
                        </h2>

                        {{-- Region --}}
                        <div class="flex items-center gap-2 text-gray-700 text-sm">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 2C8 2 5 5 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-4-3-7-7-7z" />
                                <circle cx="12" cy="9" r="2.5" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                            <span>{{ $openTrip->rizal_trip->rizal_regions->name }}</span>
                        </div>

                        {{-- Dates --}}
                        <div class="flex items-center gap-2 text-gray-700 text-sm">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M16 2v4M8 2v4M3 10h18" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <span>
                                {{ \Carbon\Carbon::parse($openTrip->start_date)->format('d M Y') }} -
                                {{ \Carbon\Carbon::parse($openTrip->end_date)->format('d M Y') }}
                            </span>
                        </div>

                        {{-- Price --}}
                        <div class="flex items-center gap-2 text-gray-700 text-sm">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M2.25 6.75h19.5v10.5H2.25V6.75z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4.5 9.75a2.25 2.25 0 0 0 0 4.5m15-4.5a2.25 2.25 0 0 1 0 4.5" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 12a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5z" />
                            </svg>
                            <span>
                                {{ $openTrip->rizal_trip->base_price ? 'Rp ' . number_format($openTrip->rizal_trip->base_price, 0, ',', '.') : 'Price not set' }}
                            </span>
                        </div>


                        {{-- Rating --}}
                        <div class="flex items-center gap-1 text-yellow-500 text-sm">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4" fill="{{ $i <= 4 ? 'currentColor' : 'none' }}" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                            @endfor
                            <span class="ml-2 text-gray-700">4.7</span>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">No trips found.</p>
            @endforelse
        </div>
    </div>



    {{-- Barang Rental --}}
    <div class="max-w-7xl mx-auto px-4 py-8 mt-20 bg-gray-100 mb-30">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Sewa Perlengkapan</h1>
            <div class="w-24 h-1 bg-blue-500 mx-auto rounded-full"></div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 items-stretch">
                <!-- Kolom kiri -->
                <div class="p-8 lg:p-12 flex flex-col justify-center">
                    <div class="space-y-6">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-800 mb-4">Sewa Perlengkapan Trip</h2>
                            <p class="text-gray-600 text-lg leading-relaxed">
                                Jangan repot bawa banyak barang. Sewa perlengkapan berkualitas untuk pengalaman perjalanan
                                yang lebih
                                santai dan nyaman.
                            </p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <button
                                class="px-8 py-3 bg-blue-500 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg text-lg font-semibold transition-all duration-300 transform hover:scale-105 shadow-md hover:bg-yellow-500 hover:text-black">
                                Lihat Semua Barang
                            </button>

                        </div>

                    </div>
                </div>

                <!-- Kolom kanan dengan gambar -->
                <div class="p-8 lg:p-12 bg-gradient-to-br from-gray-50 to-gray-100">
                    <div class="grid grid-cols-3 gap-4 h-full">
                        <!-- Gambar besar di kiri -->
                        <div
                            class="col-span-2 row-span-2 overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <img src="https://filebroker-cdn.lazada.co.id/kf/S23547fd8fa9c4a5e8917d1363ce64b8bq.jpg"
                                alt="Perlengkapan Utama"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>

                        <!-- Gambar kecil atas -->
                        <div class="overflow-hidden rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
                            <img src="https://filebroker-cdn.lazada.co.id/kf/S23547fd8fa9c4a5e8917d1363ce64b8bq.jpg"
                                alt="Perlengkapan Camping"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>

                        <!-- Gambar kecil bawah -->
                        <div class="overflow-hidden rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
                            <img src="https://filebroker-cdn.lazada.co.id/kf/S23547fd8fa9c4a5e8917d1363ce64b8bq.jpg"
                                alt="Perlengkapan Hiking"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Trip Smartly</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body>
        <section class="relative text-white py-16">
            <!-- Background -->
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e" alt=""
                    class="w-full h-full object-cover" />
                <div class="absolute inset-0 bg-black/70"></div>
            </div>

            <!-- Content -->
            <div class="relative z-10 max-w-6xl mx-auto px-4 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-12">KENAPA PILIH TRIP SMARTLY?</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <!-- Item 1 -->
                    <div class="flex flex-col items-center">
                        <div class="bg-white text-blue-600 p-4 rounded-full shadow-md mb-4">
                            <!-- Users/Group Icon -->
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold">Open Trip Seru</h3>
                        <p class="text-sm text-white/90 mt-2 max-w-xs">
                            Gabung trip seru ke destinasi impian tanpa ribet atur sendiri. Booking mudah, kami yang urus!
                        </p>
                    </div>

                    <!-- Item 2 -->
                    <div class="flex flex-col items-center">
                        <div class="bg-white text-blue-600 p-4 rounded-full shadow-md mb-4">
                            <!-- Luggage/Suitcase Icon -->
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold">Perlengkapan Lengkap</h3>
                        <p class="text-sm text-white/90 mt-2 max-w-xs">
                            Sewa tenda, carrier, dan perlengkapan lainnya langsung dari kami. Praktis & hemat.
                        </p>
                    </div>

                    <!-- Item 3 -->
                    <div class="flex flex-col items-center">
                        <div class="bg-white text-blue-600 p-4 rounded-full shadow-md mb-4">
                            <!-- Money/Price Icon -->
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold">Harga Bersahabat</h3>
                        <p class="text-sm text-white/90 mt-2 max-w-xs">
                            Nikmati layanan berkualitas tanpa bikin kantong bolong. Semua bisa jalan-jalan!
                        </p>
                    </div>
                </div>

            </div>
        </section>
















    @endsection
