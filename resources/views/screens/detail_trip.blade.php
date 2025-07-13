{{-- Navbar --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])
@include('layouts.header')

@if ($openTrip)
    {{-- Hero Section --}}
    <section class="relative overflow-hidden h-[30rem] flex items-center justify-center text-center">
        {{-- Background Image --}}
        <div class="absolute inset-0">
            @if ($openTrip->image)
                <img src="{{ asset('storage/' . $openTrip->image) }}" alt="{{ $openTrip->title }}"
                    class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-gradient-to-r from-blue-500 to-purple-600"></div>
            @endif

            {{-- Soft Gradient Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-black/10 to-transparent"></div>
        </div>
    </section>
@else
    {{-- Fallback --}}
    <section class="relative h-80 bg-gradient-to-r from-gray-500 to-gray-700 flex items-center justify-center">
        <div class="text-center text-white px-4">
            <h1 class="text-4xl font-bold mb-2">Trip Tidak Ditemukan</h1>
            <p class="text-white/80">Data trip belum tersedia.</p>
        </div>
    </section>
@endif




<div class="max-w-7xl mx-auto px-4 py-8">


    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Left Column --}}
        <div class="lg:col-span-2 space-y-8">
            {{-- Trip Title and Rating --}}
            <div class="bg-white p-6 rounded-xl shadow-lg text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">
                    {{ strtoupper($openTrip->title) }}
                </h2>
                <div class="flex items-center justify-center gap-1 mb-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <svg class="w-5 h-5" fill="{{ $i <= round($averageRating) ? '#facc15' : 'none' }}"
                            stroke="#facc15" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                        </svg>
                    @endfor
                    <span class="ml-2 text-gray-700 font-medium">
                        {{ number_format($averageRating, 1) }} ({{ $tripReviews->count() }} reviews)
                    </span>
                </div>
            </div>

            {{-- Info Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-2">

                {{-- Lokasi --}}
                @isset($openTrip->rizal_regions)
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <h3 class="text-lg font-semibold mb-2 flex items-center gap-2 text-sky-500">
                            📍 Lokasi
                        </h3>
                        <p class="text-gray-700">{{ $openTrip->rizal_regions->name }}</p>
                    </div>
                @endisset

                {{-- Meeting Point --}}
                @if ($openTrip->meeting_point)
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <h3 class="text-lg font-semibold mb-2 flex items-center gap-1 text-sky-500">
                            📌 Meeting Point
                        </h3>
                        <p class="text-gray-700">{{ $openTrip->meeting_point }}</p>
                    </div>
                @endif

                {{-- Tanggal (Gabung Start dan End) --}}
                @if ($startDateFormatted && $endDateFormatted)
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <h3 class="text-lg font-semibold mb-2 flex items-center gap-2 text-sky-500">
                            🗓️ Tanggal
                        </h3>
                        <p class="text-gray-700">
                            {{ $startDateFormatted }} – {{ $endDateFormatted }}
                        </p>

                    </div>
                @endif

                {{-- Durasi --}}
                @if ($duration)
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <h3 class="text-lg font-semibold mb-2 flex items-center gap-2 text-sky-500">
                            ⏳ Durasi
                        </h3>
                        <p class="text-sky-600 font-semibold">{{ $duration }} Hari</p>
                    </div>
                @endif

                {{-- Kategori --}}
                @isset($openTrip->rizal_categories)
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <h3 class="text-lg font-semibold mb-2 flex items-center gap-2 text-sky-500">
                            🏷️ Kategori
                        </h3>
                        <p class="text-gray-700">{{ $openTrip->rizal_categories->name }}</p>
                    </div>
                @endisset

            </div>





            {{-- Description --}}
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Deskripsi</h3>
                @if ($openTrip->description)
                    <p class="text-gray-600 leading-relaxed">{{ $openTrip->description }}</p>
                @else
                    <p class="text-gray-400 italic">Deskripsi belum tersedia untuk trip ini.</p>
                @endif
            </div>


            {{-- Destinations --}}
            @if ($openTrip->trip_destinations && $openTrip->trip_destinations->count())
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Destinasi</h3>
                    <div class="space-y-4">
                        @foreach ($openTrip->trip_destinations as $destination)
                            <div class="border-l-4 border-sky-500 pl-4">
                                <h4 class="text-lg font-medium text-gray-800 mb-2">{{ $destination->description }}</h4>
                                @if (count($destination->places))
                                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                                        @foreach ($destination->places as $place)
                                            <li>{{ $place }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-gray-400 italic">Belum ada detail destinasi.</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif


            {{-- Includes --}}
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Harga Include</h3>
                @if (!empty($openTrip->includes) && count($openTrip->includes))
                    <ul class="space-y-2">
                        @foreach ($openTrip->includes as $include)
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">{{ $include }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-400 italic">Belum ada informasi harga termasuk.</p>
                @endif
            </div>



            {{-- Excludes --}}
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Harga Exclude</h3>
                @if (!empty($openTrip->excludes) && count($openTrip->excludes))
                    <ul class="space-y-2">
                        @foreach ($openTrip->excludes as $exclude)
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <span class="text-gray-700">{{ $exclude }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-400 italic">Belum ada informasi harga tidak termasuk.</p>
                @endif
            </div>



            {{-- Itinerary --}}
            @if ($openTrip->trip_itineraries && $openTrip->trip_itineraries->count())
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Itinerary</h3>
                    <div class="space-y-4">
                        @foreach ($openTrip->trip_itineraries->groupBy('day') as $day => $itineraries)
                            <div class="border-l-4 border-sky-500 pl-4">
                                <h4 class="font-semibold text-gray-800 mb-2">Hari {{ $day }}</h4>
                                <div class="space-y-2">
                                    @foreach ($itineraries as $itinerary)
                                        <div class="bg-gray-50 p-3 rounded-lg">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="text-sky-500">🕑</span>
                                                <span
                                                    class="text-sm font-medium text-sky-600">{{ $itinerary->time }}</span>
                                            </div>
                                            @if (count($itinerary->activities))
                                                <ul class="list-disc list-inside text-gray-700 space-y-1">
                                                    @foreach ($itinerary->activities as $activity)
                                                        <li>{{ $activity }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p class="text-gray-400 italic">Belum ada aktivitas.</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif



            {{-- Reviews --}}
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Review</h3>
                @if ($tripReviews->count() > 0)
                    <div class="space-y-4">
                        @foreach ($tripReviews as $review)
                            <div class="border-b border-gray-200 pb-4 last:border-b-0">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-10 h-10 bg-sky-500 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold">
                                            {{ substr($review->user_name ?? 'G', 0, 1) }}
                                        </span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-800">{{ $review->user_name ?? 'Guest' }}</h4>
                                        <div class="flex items-center gap-1">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                                </svg>
                                            @endfor
                                            <span class="text-sm text-gray-500 ml-1">{{ $review->rating }}/5</span>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-700 ml-13">{{ $review->comment }}</p>
                                <p class="text-sm text-gray-500 mt-2 ml-13">{{ $review->created_at->diffForHumans() }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Belum ada review untuk trip ini.</p>
                @endif
            </div>
        </div>

        {{-- Right Column --}}
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-xl shadow-lg sticky top-8">
                <div class="text-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Harga</h3>
                    <div id="displayPrice" class="text-3xl font-bold text-sky-600">
                        Rp {{ number_format($openTrip->base_price, 0, ',', '.') }}
                    </div>
                    <p class="text-sm text-gray-500">per orang</p>
                </div>
                <div class="bg-sky-50 p-4 rounded-lg mb-6">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-700">Kuota Tersedia</span>
                        <span class="font-semibold text-sky-600">{{ $availableQuota }} orang</span>
                    </div>
                </div>

                <form action="{{ route('tripStore', $openTrip->id) }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="flex items-center space-x-4">
                        <label class="block text-gray-700 font-medium">Jumlah Orang</label>

                        <div class="flex items-center space-x-2">
                            <button type="button" id="decrease"
                                class="bg-sky-100 hover:bg-sky-200 text-sky-600 px-3 py-1 rounded-full text-lg">−</button>

                            <span id="participantsDisplay"
                                class="min-w-[2rem] text-center text-gray-800 font-semibold">{{ 1 }}</span>

                            <input type="hidden" name="participants" id="participants" value="1">

                            <button type="button" id="increase"
                                class="bg-sky-100 hover:bg-sky-200 text-sky-600 px-3 py-1 rounded-full text-lg">+</button>
                        </div>
                    </div>
                    <div class="flex items-center justify-start space-x-10">
                        <span class="text-gray-700 font-medium">Total Harga</span>
                        <span id="totalPriceDisplay" class="text-xl font-bold text-sky-600">
                            Rp {{ number_format($openTrip->base_price, 0, ',', '.') }}
                        </span>
                    </div>

                    <button id="openModalButton" type="button" data-modal-target="bookingModal"
                        data-modal-toggle="bookingModal"
                        class="w-full bg-sky-500 text-white py-3 rounded-lg font-semibold hover:bg-sky-600 transition-colors">
                        Pesan Sekarang
                    </button>


                </form>

                <div class="text-center mt-4">
                    <p class="text-sm text-gray-600 mb-2">Ada pertanyaan?</p>
                    <button class="text-sky-500 hover:text-sky-600 font-medium">
                        Hubungi Kami
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('participants');
        const increaseBtn = document.getElementById('increase');
        const decreaseBtn = document.getElementById('decrease');
        const participantsDisplay = document.getElementById('participantsDisplay');
        const totalPriceDisplay = document.getElementById('totalPriceDisplay');
        const pricePerPerson = {{ $openTrip->base_price }};
        const maxQuota = {{ $availableQuota }};

        function updateTotal() {
            const value = parseInt(input.value);
            const total = value * pricePerPerson;

            // ✅ update elemen span juga
            participantsDisplay.textContent = value;

            totalPriceDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        increaseBtn.addEventListener('click', function() {
            let value = parseInt(input.value);
            if (value < maxQuota) {
                input.value = value + 1;
                updateTotal();
            }
        });

        decreaseBtn.addEventListener('click', function() {
            let value = parseInt(input.value);
            if (value > 1) {
                input.value = value - 1;
                updateTotal();
            }
        });

        // Update total on page load
        updateTotal();
    });
</script>


@include('screens.order_trip')


{{-- Footer --}}
@include('layouts.footer')
