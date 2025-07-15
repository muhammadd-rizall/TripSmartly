<!-- Trip Detail Modal -->
<div id="tripDetailModal" class="fixed flex inset-0 z-50 bg-black/50 items-center justify-center hidden">

    <div class="bg-white rounded-2xl max-w-xl w-full p-6 shadow-xl relative overflow-y-auto max-h-[90vh]">
        <!-- Close Button -->
        <button onclick="closeTripModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Title -->
        <h2 class="text-2xl font-bold mb-4 text-gray-900 border-b pb-3">Order Details</h2>

        <!-- Details -->
        <div class="space-y-5 text-sm text-gray-800">
            <div class="flex justify-between">
                <div>
                    <p class="text-gray-500">Order ID</p>
                    <p id="trip-order-id" class="font-semibold">#</p>
                </div>
                <div>
                    <p class="text-gray-500">Order Date</p>
                    <p id="trip-order-date" class="font-semibold"></p>
                </div>
            </div>

            <div>
                <p class="text-gray-500">Title</p>
                <p id="trip-title" class="font-semibold"></p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-500">Category</p>
                    <p id="trip-category" class="font-semibold"></p>
                </div>
                <div>
                    <p class="text-gray-500">Region</p>
                    <p id="trip-region" class="font-semibold"></p>
                </div>
            </div>

            <div>
                <p class="text-gray-500">Meeting Point</p>
                <p id="trip-meeting-point" class="font-semibold"></p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a4 4 0 00-3-3.87M9 20h6M9 4a4 4 0 110 8 4 4 0 010-8zM17 9v1a3 3 0 01-3 3H7a3 3 0 01-3-3V9" />
                    </svg>
                    <div>
                        <p class="text-gray-500">Participants</p>
                        <p id="trip-participants" class="font-semibold"></p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7h18M3 12h18M3 17h18" />
                    </svg>
                    <div>
                        <p class="text-gray-500">Quota</p>
                        <p id="trip-quota" class="font-semibold"></p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-500">Status</p>
                    <span id="trip-status"
                        class="inline-block px-2 py-1 text-xs rounded-full bg-green-50 text-green-600">completed</span>
                </div>
                <div>
                    <p class="text-gray-500">Payment Status</p>
                    <span id="trip-payment-status"
                        class="inline-block px-2 py-1 text-xs rounded-full bg-green-50 text-green-600">paid</span>
                </div>
            </div>

            <div class="border-t border-gray-200 pt-4">
                <p class="text-gray-500">Total Price</p>
                <p id="trip-total-price" class="text-xl font-bold text-blue-600"></p>
            </div>
        </div>

        <div class="mt-6 text-right">
            <button onclick="closeTripModal()"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Close</button>
        </div>

    </div>
</div>
</div>
