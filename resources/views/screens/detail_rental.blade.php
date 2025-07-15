@include('layouts.header')
@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="max-w-7xl mx-auto px-4 py-8 mt-20">
    <!-- Main Product Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Kiri - Gambar --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-4">
                    @if ($rentalItem->image)
                        <img src="{{ asset('storage/' . $rentalItem->image) }}" alt="{{ $rentalItem->name }}"
                            class="w-full h-80 object-cover rounded-lg hover:scale-105 transition-transform duration-300">
                    @else
                        <div class="w-full h-80 bg-gray-200 rounded-lg flex items-center justify-center">
                            <span class="text-gray-500">No Image Available</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Tengah - Informasi Produk --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg p-6 h-full">
                <div class="mb-2">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $rentalItem->name }}</h1>

                    <div class="mb-1">
                        <p class="font-small text-gray-700">{{ $rentalItem->rizal_rental_categories->name }}</p>
                    </div>

                    <div class="flex items-center gap-2 mb-5">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5" fill="{{ $i <= round($averageRating) ? '#facc15' : 'none' }}"
                                stroke="#facc15" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                            </svg>
                        @endfor
                        <span class="text-gray-600 font-medium">
                            {{ number_format($averageRating, 1) }} ({{ $rentalReviews->count() }} reviews)
                        </span>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-3">Deskripsi</h3>
                    @if ($rentalItem->description)
                        <p class="text-gray-600 leading-relaxed">{{ Str::words($rentalItem->description, 100, '...') }}
                        </p>
                    @else
                        <p class="text-gray-500 italic">Deskripsi tidak tersedia</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Kanan - Banner Harga & Pemesanan --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg p-6 sticky top-4">
                <div class="text-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Harga Sewa</h3>
                    <div id="displayPrice" class="text-3xl font-bold text-sky-600">
                        Rp {{ number_format($rentalItem->price_per_day, 0, ',', '.') }}
                    </div>
                    <p class="text-sm text-gray-500">per hari</p>
                    <div class="bg-sky-50 p-4 rounded-lg mt-5">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700">Stok Tersedia</span>
                            <span class="font-semibold text-sky-600">{{ $availableStock }} item</span>
                        </div>
                    </div>
                </div>

                <form class="space-y-4" id="mainRentalForm">
                    @csrf
                    <input type="hidden" id="quantity" value="1">
                    <input type="hidden" id="pricePerDay" value="{{ $rentalItem->price_per_day }}">

                    <div class="flex items-center justify-between gap-6">
                        <label class="text-gray-700 font-medium whitespace-nowrap">Jumlah Barang</label>
                        <div class="flex items-center space-x-5">
                            <button type="button" id="decrease"
                                class="bg-sky-100 hover:bg-sky-200 text-sky-600 w-10 h-10 rounded-full text-lg font-semibold">−</button>
                            <span id="quantityDisplay"
                                class="min-w-[3rem] text-center text-gray-800 font-bold text-xl">1</span>
                            <button type="button" id="increase"
                                class="bg-sky-100 hover:bg-sky-200 text-sky-600 w-10 h-10 rounded-full text-lg font-semibold">+</button>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg border-2 border-gray-200">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700 font-medium">Total Harga</span>
                            <span id="totalPriceDisplay" class="text-xl font-bold text-sky-600">
                                Rp {{ number_format($rentalItem->price_per_day, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <div class="space-y-4 mt-4">
                        <div>
                            <label for="startDateInput" class="text-gray-700 font-medium mb-1 block">Tanggal Mulai
                                Sewa</label>
                            <input type="date" id="startDateInput" required class="w-full border-gray-300 rounded-lg"
                                min="{{ date('Y-m-d') }}">
                        </div>
                        <div>
                            <label for="endDateInput" class="text-gray-700 font-medium mb-1 block">Tanggal Selesai
                                Sewa</label>
                            <input type="date" id="endDateInput" required class="w-full border-gray-300 rounded-lg"
                                min="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    @auth
                        <button id="openModalButton" type="button"
                            class="w-full bg-gradient-to-r from-sky-500 to-blue-500 text-white py-3 rounded-lg font-semibold hover:from-sky-600 hover:to-blue-600">
                            Pesan Sekarang
                        </button>
                    @else
                        <a href="{{ route('login') }}"
                            class="block text-center bg-sky-500 text-white py-3 rounded-lg hover:bg-sky-600">
                            Login untuk Pesan
                        </a>
                    @endauth
                </form>
            </div>
        </div>
    </div>


    {{-- Reviews Section --}}
    <div class="mt-12">
        <div class="bg-sky-100 rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Reviews & Rating</h2>
                <button class="bg-sky-500 text-white px-4 py-2 rounded-lg hover:bg-sky-600 transition-colors">
                    Tulis Review
                </button>
            </div>

            <!-- Rating Summary -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="text-center">
                    <div class="text-4xl font-bold text-sky-600 mb-2">
                        {{ number_format($averageRating, 1) }}
                    </div>
                    <div class="flex items-center justify-center gap-1 mb-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5" fill="{{ $i <= round($averageRating) ? '#facc15' : 'none' }}"
                                stroke="#facc15" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                            </svg>
                        @endfor
                    </div>
                    <p class="text-gray-600">{{ $rentalReviews->count() }} Reviews</p>
                </div>

                <div class="md:col-span-2">
                    <div class="space-y-2">
                        @for ($i = 5; $i >= 1; $i--)
                            @php
                                $count = $rentalReviews->where('rating', $i)->count();
                                $percentage =
                                    $rentalReviews->count() > 0 ? ($count / $rentalReviews->count()) * 100 : 0;
                            @endphp
                            <div class="flex items-center gap-2">
                                <span class="text-sm text-gray-600 w-8">{{ $i }}★</span>
                                <div class="flex-1 bg-gray-200 rounded-full h-2">
                                    <div class="bg-yellow-400 h-2 rounded-full" style="width: {{ $percentage }}%">
                                    </div>
                                </div>
                                <span class="text-sm text-gray-600 w-8">{{ $count }}</span>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Reviews List -->
            <div class="space-y-6">
                @forelse ($rentalReviews as $review)
                    <div class="border-b border-gray-200 pb-6 last:border-b-0">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-sky-100 rounded-full flex items-center justify-center">
                                <span class="text-sky-600 font-semibold">
                                    {{ substr($review->user->name ?? 'G', 0, 1) }}
                                </span>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <h4 class="font-semibold text-gray-800">{{ $review->user->name ?? 'Guest' }}</h4>
                                    <div class="flex items-center gap-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4"
                                                fill="{{ $i <= $review->rating ? '#facc15' : 'none' }}"
                                                stroke="#facc15" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-gray-600 mb-2">{{ $review->comment }}</p>
                                <p class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <div class="text-gray-400 text-6xl mb-4">💭</div>
                        <p class="text-gray-600">Belum ada review untuk produk ini</p>
                        <p class="text-gray-500 text-sm">Jadilah yang pertama memberikan review!</p>
                    </div>
                @endforelse
            </div>

            <!-- Load More Reviews -->
            @if ($rentalReviews->count() > 5)
                <div class="text-center mt-6">
                    <button class="text-sky-500 hover:text-sky-600 font-medium underline">
                        Lihat Semua Reviews
                    </button>
                </div>
            @endif
        </div>
    </div>


</div>




<script>
document.addEventListener('DOMContentLoaded', function() {
    const quantityInput = document.getElementById('quantity');
    const increaseBtn = document.getElementById('increase');
    const decreaseBtn = document.getElementById('decrease');
    const quantityDisplay = document.getElementById('quantityDisplay');
    const totalPriceDisplay = document.getElementById('totalPriceDisplay');
    const pricePerDay = parseInt(document.getElementById('pricePerDay').value, 10);
    const maxQuota = {{ $availableStock }};

    // Set minimum date untuk input tanggal
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('startDateInput').min = today;
    document.getElementById('endDateInput').min = today;

    // Update tanggal end ketika start date berubah
    document.getElementById('startDateInput').addEventListener('change', function() {
        const startDate = this.value;
        document.getElementById('endDateInput').min = startDate;
    });

    function updateTotal() {
        const value = parseInt(quantityInput.value);
        const total = value * pricePerDay;
        quantityDisplay.textContent = value;
        totalPriceDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
    }

    function updateButtonStates() {
        const value = parseInt(quantityInput.value);
        decreaseBtn.disabled = value <= 1;
        increaseBtn.disabled = value >= maxQuota;
        decreaseBtn.classList.toggle('opacity-50', value <= 1);
        increaseBtn.classList.toggle('opacity-50', value >= maxQuota);
    }

    increaseBtn.addEventListener('click', () => {
        let value = parseInt(quantityInput.value);
        if (value < maxQuota) {
            quantityInput.value = value + 1;
            updateTotal();
            updateButtonStates();
        }
    });

    decreaseBtn.addEventListener('click', () => {
        let value = parseInt(quantityInput.value);
        if (value > 1) {
            quantityInput.value = value - 1;
            updateTotal();
            updateButtonStates();
        }
    });

    updateTotal();
    updateButtonStates();

    // Modal handling
    const openModalButton = document.getElementById('openModalButton');
    const bookingModal = document.getElementById('bookingModal');
    const startDateInput = document.getElementById('startDateInput');
    const endDateInput = document.getElementById('endDateInput');
    const modalQuantity = document.getElementById('modalQuantity');
    const modalDays = document.getElementById('modalDays');
    const modalTotalPrice = document.getElementById('modalTotalPrice');
    const modalQuantityInput = document.getElementById('modalQuantityInput');
    const modalStartDateInput = document.getElementById('modalStartDateInput');
    const modalEndDateInput = document.getElementById('modalEndDateInput');

    openModalButton.addEventListener('click', () => {
        const quantity = parseInt(quantityInput.value, 10);
        const startDateValue = startDateInput.value;
        const endDateValue = endDateInput.value;

        // Validasi input
        if (!startDateValue || !endDateValue) {
            alert('Silakan pilih tanggal mulai dan tanggal selesai sewa terlebih dahulu.');
            return;
        }

        const startDate = new Date(startDateValue);
        const endDate = new Date(endDateValue);

        if (endDate <= startDate) {
            alert('Tanggal selesai harus setelah tanggal mulai.');
            return;
        }

        let days = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;
        if (isNaN(days) || days < 1) days = 1;

        const totalPrice = pricePerDay * quantity * days;

        // Update modal content
        modalQuantity.textContent = quantity;
        modalDays.textContent = `${days} Hari`;
        modalTotalPrice.textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;

        // Set hidden inputs
        modalQuantityInput.value = quantity;
        modalStartDateInput.value = startDateValue;
        modalEndDateInput.value = endDateValue;

        // Show modal
        bookingModal.classList.remove('hidden');
        bookingModal.classList.add('flex');
    });

    // Form validation
    document.getElementById('orderForm').addEventListener('submit', function(e) {
        const deliveryLocation = document.getElementById('delivery_location').value.trim();
        const paymentMethod = document.getElementById('payment_methods').value;

        if (!deliveryLocation) {
            e.preventDefault();
            alert('Alamat pengiriman harus diisi');
            return;
        }

        if (!paymentMethod) {
            e.preventDefault();
            alert('Metode pembayaran harus dipilih');
            return;
        }
    });
});

function closeBookingModal() {
    const bookingModal = document.getElementById('bookingModal');
    bookingModal.classList.add('hidden');
    bookingModal.classList.remove('flex');
}
</script>


@include('screens.order_rental')

@include('layouts.footer')
