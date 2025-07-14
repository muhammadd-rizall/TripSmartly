@extends('admins.dashboard')
@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Dashboard Admin</h1>
                <p class="text-gray-600">Selamat datang di panel administrasi</p>
            </div>

            <!-- Stats Cards Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 mb-8">
                <!-- Total Trip Card -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-1">Total Trip</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $totalTrip ?? '0' }}</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fas fa-route text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Order Trip Card -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-1">Order Trip</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $orderTrip ?? '0' }}</p>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-full">
                            <i class="fas fa-clipboard-list text-purple-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Rental Card -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-1">Total Rental</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $totalRental ?? '0' }}</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fas fa-car text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Order Sewa Card -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-orange-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-1">Order Sewa</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $orderRental ?? '0' }}</p>
                        </div>
                        <div class="bg-orange-100 p-3 rounded-full">
                            <i class="fas fa-handshake text-orange-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total User Card -->
                <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-red-500 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium mb-1">Total User</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $totalUser ?? '0' }}</p>
                        </div>
                        <div class="bg-red-100 p-3 rounded-full">
                            <i class="fas fa-users text-red-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Revenue Section -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <div class="text-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">
                        <i class="fas fa-chart-line text-green-600 mr-3"></i> PENDAPATAN
                    </h2>
                    <p class="text-gray-600">Ringkasan pendapatan bulanan</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div class="space-y-6">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-6 text-white shadow-lg">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-lg font-semibold">Pendapatan Trip</h3>
                                <i class="fas fa-route text-xl opacity-80"></i>
                            </div>
                            <p class="text-2xl font-bold mb-2">Rp {{ number_format($pendapatanTrip ?? 0, 0, ',', '.') }}</p>
                        </div>

                        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-6 text-white shadow-lg">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-lg font-semibold">Pendapatan Rental</h3>
                                <i class="fas fa-car text-xl opacity-80"></i>
                            </div>
                            <p class="text-2xl font-bold mb-2">Rp {{ number_format($pendapatanRental ?? 0, 0, ',', '.') }}</p>
                        </div>

                        <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg p-6 text-center text-white shadow-lg">
                            <h3 class="text-lg font-semibold mb-3">
                                <i class="fas fa-trophy mr-2"></i> TOTAL PENDAPATAN
                            </h3>
                            <p class="text-3xl font-bold mb-2">
                                Rp {{ number_format(($pendapatanTrip ?? 0) + ($pendapatanRental ?? 0), 0, ',', '.') }}
                            </p>
                            <p class="text-purple-100 text-sm">
                                <i class="fas fa-calendar-alt mr-1"></i> Bulan ini ({{ date('F Y') }})
                            </p>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6 shadow-inner">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 text-center">Grafik Pendapatan</h3>
                        <div class="chart-container" style="position: relative; height: 300px;">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Trip Table -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Data Order Trip</h1>
                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                        <i class="fas fa-table"></i>
                        <span>{{ count($dataOrderTrip) }} data</span>
                    </div>
                </div>
                <div class="overflow-x-auto bg-white rounded-lg shadow border border-gray-200">
                    <table class=" w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nama User</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Trip</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Participant</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($dataOrderTrip as $index => $order)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 text-center font-medium text-gray-900">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 text-gray-900 font-medium">{{ $order->user->name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-gray-900 font-medium">{{ $order->rizal_trip->title ?? '-' }}</td>
                                    <td class="px-6 py-4 text-gray-900 font-medium">{{ $order->rizal_trip->rizal_categories->name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-gray-900 font-medium text-center">{{ $order->participants ?? 0 }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-gray-500 py-8">
                                        <div class="flex flex-col items-center space-y-2">
                                            <i class="fas fa-inbox text-gray-400 text-3xl"></i>
                                            <span>Tidak ada data.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Order Rental Table -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Data Order Rental</h1>
                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                        <i class="fas fa-table"></i>
                        <span>{{ count($dataOrderRental) }} data</span>
                    </div>
                </div>
                <div class="overflow-x-auto bg-white rounded-lg shadow border border-gray-200">
                    <table class=" w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nama User</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Item</th>
                                <th class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($dataOrderRental as $index => $order)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 text-center font-medium text-gray-900">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 text-gray-900 font-medium">{{ $order->user->name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-gray-900 font-medium">{{ $order->rizal_rental_item->name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-gray-900 font-medium text-center">{{ $order->quantity ?? 0 }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-gray-500 py-8">
                                        <div class="flex flex-col items-center space-y-2">
                                            <i class="fas fa-inbox text-gray-400 text-3xl"></i>
                                            <span>Tidak ada data.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
        const monthlyData = {!! json_encode($monthlyRevenue) !!};
    </script>


@endsection
