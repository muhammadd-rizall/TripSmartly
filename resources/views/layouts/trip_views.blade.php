{{-- Navbar --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])
@include('layouts.header')

{{-- Hero Section --}}
<section class="bg-sky-100 pt-28 pb-12">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-sky-700 mb-8">
            Temukan Trip Impianmu
        </h2>
        <form action="{{ route('tripViews') }}" method="GET"
            class="flex flex-col md:flex-row gap-4 bg-white p-5 rounded-xl shadow-lg">
            <!-- Search -->
            <div class="flex flex-1">
                <input type="text" name="search" placeholder="Cari Destinasi, Trip, dan Region..."
                    class="w-full px-4 h-12 rounded-l-lg border-2 border-sky-500 focus:outline-none focus:border-sky-600"
                    value="{{ request('search') }}" />
                <button type="submit" class="bg-sky-500 text-white rounded-r-lg px-4 hover:bg-sky-600 transition">
                    Cari
                </button>
            </div>

            <!-- Dropdown Filter -->
            <select name="category"
                class="w-full md:w-48 h-12 border-2 border-sky-500 focus:outline-none focus:border-sky-600 text-sky-600 rounded-lg px-3">
                <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>Semua Kategori</option>
                <option value="pantai" {{ request('category') == 'pantai' ? 'selected' : '' }}>Pantai</option>
                <option value="gunung" {{ request('category') == 'gunung' ? 'selected' : '' }}>Gunung</option>
                <option value="wisata_kota" {{ request('category') == 'wisata_kota' ? 'selected' : '' }}>Wisata Kota
                </option>
                <option value="wisata_alam" {{ request('category') == 'wisata_alam' ? 'selected' : '' }}>Wisata Alam
                </option>
                <option value="sejarah_dan_budaya" {{ request('category') == 'sejarah_dan_budaya' ? 'selected' : '' }}>
                    Sejarah & Budaya</option>
                <option value="agrowisata" {{ request('category') == 'agrowisata' ? 'selected' : '' }}>Agrowisata
                </option>
                <option value="camping_glamping" {{ request('category') == 'camping_glamping' ? 'selected' : '' }}>
                    Clamping / Glamping</option>
                <option value="festival_dan_event" {{ request('category') == 'festival_dan_event' ? 'selected' : '' }}>
                    Festival & Event</option>
            </select>
        </form>


    </div>
</section>


{{-- Cek kalau semua kategori kosong --}}
@if ($openTrips->flatten()->isEmpty())
    <div class="max-w-4xl mx-auto px-4 text-center py-12">
        <p class="text-gray-500 text-lg">
            😔 Maaf, tidak ada trip ditemukan sesuai pencarian atau filter yang kamu pilih.
        </p>
    </div>
@else
    {{-- Loop hanya kategori yang ada trip --}}
    @foreach ($openTrips as $categoryName => $trips)
        @if ($trips->isNotEmpty())
            <div class="max-w-6xl mx-auto p-4 mt-20">
                <div class="text-left mb-8">
                    <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $categoryName }}</h1>
                    <div class="w-32 h-1 bg-blue-500 rounded-full"></div>
                </div>

                <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($trips as $openTrip)
                        <div
                            class="bg-white rounded-2xl shadow-lg overflow-hidden hover:scale-[1.02] transition-transform duration-300">
                            <img src="{{ $openTrip->rizal_trip->image }}" alt="{{ $openTrip->rizal_trip->title }}"
                                class="w-full h-60 object-cover">

                            <div class="p-4 space-y-3">
                                {{-- Title --}}
                                <h2 class="text-lg font-bold text-gray-800 truncate">
                                    {{ $openTrip->rizal_trip->title }}
                                </h2>

                                {{-- Region --}}
                                <div class="flex items-center gap-2 text-gray-700 text-sm">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M12 2C8 2 5 5 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-4-3-7-7-7z" />
                                        <circle cx="12" cy="9" r="2.5" stroke="currentColor"
                                            stroke-width="1.5" />
                                    </svg>
                                    <span>{{ $openTrip->rizal_trip->rizal_regions->name }}</span>
                                </div>

                                {{-- Category --}}
                                <div class="flex items-center gap-2 text-gray-700 text-sm">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                    <span>{{ $openTrip->rizal_trip->rizal_categories->name }}</span>
                                </div>

                                {{-- Dates --}}
                                <div class="flex items-center gap-2 text-gray-700 text-sm">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
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
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
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
                                        <svg class="w-4 h-4" fill="{{ $i <= 4 ? 'currentColor' : 'none' }}"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                        </svg>
                                    @endfor
                                    <span class="ml-2 text-gray-700">4.7</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach
@endif

{{-- footer --}}
@include('layouts.footer')
