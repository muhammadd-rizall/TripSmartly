@vite(['resources/css/app.css', 'resources/js/app.js'])
@include('layouts.header')

<div class="min-h-screen bg-gray-50 mt-20">
    <div class="max-w-6xl mx-auto px-4 py-10">
        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Order History</h1>
            <p class="text-gray-600">Track and manage your trips and rentals</p>
        </div>

        <!-- Tabs -->
        <div class="flex justify-center space-x-4 mb-8">
            @foreach (['all' => 'All', 'trip' => 'Trips', 'rental' => 'Rentals'] as $key => $label)
                <a href="{{ route('historiOrder', ['tab' => $key, 'search' => $search]) }}"
                   class="px-4 py-2 border-b-2 {{ $tab === $key ? 'border-blue-600 text-blue-600 font-medium' : 'border-transparent text-gray-500 hover:text-blue-600 hover:border-blue-300 transition' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <!-- Search -->
        <form method="GET" action="{{ route('historiOrder') }}" class="relative max-w-lg mx-auto mb-10">
            <input type="hidden" name="tab" value="{{ $tab }}">
            <input type="text" name="search" value="{{ $search }}" placeholder="Search orders..."
                   class="w-full pl-4 pr-4 py-3 rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
        </form>

        <!-- Orders Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($tripOrders as $order)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 hover:shadow-md transition overflow-hidden">
                    @if ($order->rizal_trip && $order->rizal_trip->image)
                        <img src="{{ asset('storage/' . $order->rizal_trip->image) }}"
                             alt="{{ $order->rizal_trip->title }}" class="w-full h-48 object-cover">
                    @endif
                    <div class="p-5 flex flex-col h-full space-y-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">{{ $order->rizal_trip->title }}</h3>
                                <p class="text-xs text-gray-500 mt-1">Order #{{ $order->id }} • {{ $order->created_at->format('d M Y') }}</p>
                            </div>
                            <span class="text-xs font-medium rounded-full px-2 py-1 text-gray-600 bg-gray-50">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-700">
                            <i data-lucide="map-pin" class="w-4 h-4 text-gray-500"></i>
                            <span class="font-medium">Region:</span>
                            <span class="text-gray-600">{{ $order->rizal_trip->rizal_regions->name ?? '-' }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-700">
                            <i data-lucide="users" class="w-4 h-4 text-gray-500"></i>
                            <span class="font-medium">Participants:</span>
                            <span class="text-gray-600">{{ $order->participants }}</span>
                        </div>
                        <div class="text-xl font-bold text-blue-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                        <div class="grid grid-cols-2 gap-3">
                            <a href="#"
                               onclick="openTripModal({
                                   id: '{{ $order->id }}',
                                   date: '{{ $order->created_at->format('d M Y') }}',
                                   title: '{{ $order->rizal_trip->title }}',
                                   category: '{{ $order->rizal_trip->category ?? '-' }}',
                                   region: '{{ $order->rizal_trip->rizal_regions->name ?? '-' }}',
                                   meetingPoint: '{{ $order->rizal_trip->meeting_point ?? '' }}',
                                   participants: '{{ $order->participants }}',
                                   quota: '{{ $order->rizal_trip->quota }}',
                                   status: '{{ ucfirst($order->status) }}',
                                   paymentStatus: '{{ ucfirst($order->payment_status ?? '-') }}',
                                   price: 'Rp {{ number_format($order->total_price, 0, ',', '.') }}'
                               })"
                               class="text-center py-2 border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">Details</a>
                            @if ($order->status === 'completed')
                                <a href="{{ route('reviewTripForm', $order->id) }}" class="text-center py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 transition">Review</a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
            @endforelse

            @forelse ($rentalOrders as $order)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 hover:shadow-md transition overflow-hidden">
                    @if ($order->rizal_rental_item && $order->rizal_rental_item->image)
                        <img src="{{ asset('storage/' . $order->rizal_rental_item->image) }}"
                             alt="{{ $order->rizal_rental_item->name }}" class="w-full h-48 object-cover">
                    @endif
                    <div class="p-5 flex flex-col h-full space-y-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">{{ $order->rizal_rental_item->name }}</h3>
                                <p class="text-xs text-gray-500 mt-1">Order #{{ $order->id }} • {{ $order->created_at->format('d M Y') }}</p>
                            </div>
                            <span class="text-xs font-medium rounded-full px-2 py-1 text-gray-600 bg-gray-50">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-700">
                            <i data-lucide="calendar" class="w-4 h-4 text-gray-500"></i>
                            <span class="font-medium">Rental Period:</span>
                            <span class="text-gray-600">{{ $order->start_date }} - {{ $order->end_date }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-700">
                            <i data-lucide="package" class="w-4 h-4 text-gray-500"></i>
                            <span class="font-medium">Quantity:</span>
                            <span class="text-gray-600">{{ $order->quantity }}</span>
                        </div>
                        <div class="text-xl font-bold text-blue-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                        <div class="grid grid-cols-2 gap-3">
                            <a href="#"
                               onclick="openRentalModal({
                                   id: '{{ $order->id }}',
                                   date: '{{ $order->created_at->format('d M Y') }}',
                                   name: '{{ $order->rizal_rental_item->name }}',
                                   period: '{{ $order->start_date }} - {{ $order->end_date }}',
                                   quantity: '{{ $order->quantity }}',
                                   status: '{{ ucfirst($order->status) }}',
                                   paymentStatus: '{{ ucfirst($order->payment_status ?? '-') }}',
                                   price: 'Rp {{ number_format($order->total_price, 0, ',', '.') }}'
                               })"
                               class="text-center py-2 border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">Details</a>
                            @if ($order->status === 'completed')
                                <a href="{{ route('reviewRentalForm', $order->id) }}" class="text-center py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 transition">Review</a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>

        @if ($tripOrders->isEmpty() && $rentalOrders->isEmpty())
            <div class="text-center py-16">
                <div class="text-gray-400 text-5xl mb-4">📦</div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No orders found</h3>
                <p class="text-gray-600">Try adjusting your search or tab</p>
            </div>
        @endif
    </div>
</div>

@include('screens.modal_detail_order_rental')
@include('screens.modal_detail_order_trip')

<script>
    function closeAllOrderModals() {
        let tripModal = document.getElementById('tripDetailModal');
        let rentalModal = document.getElementById('rentalDetailModal');
        if (tripModal) tripModal.classList.add('hidden');
        if (rentalModal) rentalModal.classList.add('hidden');
    }

    function openTripModal(data) {
        closeAllOrderModals();
        document.getElementById('trip-order-id').textContent = '#' + data.id;
        document.getElementById('trip-order-date').textContent = data.date || '-';
        document.getElementById('trip-title').textContent = data.title || '-';
        document.getElementById('trip-category').textContent = data.category || '-';
        document.getElementById('trip-region').textContent = data.region || '-';
        document.getElementById('trip-meeting-point').textContent = data.meetingPoint || '-';
        document.getElementById('trip-participants').textContent = (data.participants || '-') + ' person(s)';
        document.getElementById('trip-quota').textContent = (data.quota || '-') + ' person(s)';
        document.getElementById('trip-status').textContent = data.status || '-';
        document.getElementById('trip-payment-status').textContent = data.paymentStatus || '-';
        document.getElementById('trip-total-price').textContent = data.price || '-';
        document.getElementById('tripDetailModal').classList.remove('hidden');
    }

    function closeTripModal() {
        closeAllOrderModals();
    }

    function openRentalModal(data) {
        closeAllOrderModals();
        document.getElementById('rental-order-id').textContent = '#' + (data.id || '');
        document.getElementById('rental-order-date').textContent = data.date || '-';
        document.getElementById('rental-item-name').textContent = data.name || '-';
        document.getElementById('rental-period').textContent = data.period || '-';
        document.getElementById('rental-quantity').textContent = data.quantity || '-';
        document.getElementById('rental-status').textContent = data.status || '-';
        document.getElementById('rental-payment-status').textContent = data.paymentStatus || '-';
        document.getElementById('rental-total-price').textContent = data.price || '-';
        document.getElementById('rentalDetailModal').classList.remove('hidden');
    }

    function closeRentalModal() {
        closeAllOrderModals();
    }
</script>
