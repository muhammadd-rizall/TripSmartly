<!-- Rental Detail Modal -->
    <div id="rentalDetailModal" class="fixed flex inset-0 z-50 bg-black/20 items-center justify-center hidden">
        <div class="bg-white rounded-lg max-w-md w-full mx-4 shadow-lg relative overflow-hidden max-h-[90vh] flex flex-col">

            <!-- Header -->
            <div class="p-5 border-b border-gray-100">
                <button onclick="closeRentalModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <h2 class="text-lg font-semibold text-gray-900">Rental Details</h2>
            </div>

            <!-- Content -->
            <div class="p-5 overflow-y-auto flex-1">
                <div class="space-y-4">

                    <!-- Order Info -->
                    <div class="flex justify-between text-sm">
                        <div>
                            <p class="text-gray-500 mb-1">Order ID</p>
                            <p id="rental-order-id" class="font-medium text-gray-900">#12345</p>
                        </div>
                        <div>
                            <p class="text-gray-500 mb-1">Order Date</p>
                            <p id="rental-order-date" class="font-medium text-gray-900">2024-01-15</p>
                        </div>
                    </div>

                    <!-- Item Name -->
                    <div>
                        <p class="text-gray-500 text-sm mb-1">Item Name</p>
                        <p id="rental-item-name" class="font-semibold text-gray-900">Canon EOS R5 Camera</p>
                    </div>

                    <!-- Rental Period -->
                    <div>
                        <p class="text-gray-500 text-sm mb-1">Rental Period</p>
                        <p id="rental-period" class="font-medium text-gray-900">Jan 15 - Jan 20, 2024</p>
                    </div>

                    <!-- Quantity -->
                    <div>
                        <p class="text-gray-500 text-sm mb-1">Quantity</p>
                        <p id="rental-quantity" class="font-medium text-gray-900">1 unit</p>
                    </div>

                    <!-- Status & Payment -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-500 text-sm mb-1">Status</p>
                            <span id="rental-status" class="inline-flex items-center px-2 py-1 text-xs rounded bg-green-100 text-green-700 font-medium">
                                completed
                            </span>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm mb-1">Payment</p>
                            <span id="rental-payment-status" class="inline-flex items-center px-2 py-1 text-xs rounded bg-blue-100 text-blue-700 font-medium">
                                paid
                            </span>
                        </div>
                    </div>

                    <!-- Total Price -->
                    <div class="pt-4 border-t border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Total Price</p>
                                <p id="rental-total-price" class="text-xl font-bold text-gray-900">$250.00</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Footer -->
            <div class="p-4 border-t border-gray-100">
                <div class="flex justify-end">
                    <button onclick="closeRentalModal()" class="px-4 py-2 bg-gray-900 text-white rounded text-sm hover:bg-gray-800 transition-colors">
                        Close
                    </button>
                </div>
            </div>

        </div>
    </div>
