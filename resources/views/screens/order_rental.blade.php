<div id="bookingModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl p-6 max-w-md w-full mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-800">Konfirmasi Pesanan</h3>
            <button onclick="closeBookingModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Form dengan action yang benar sesuai routing -->
        <form action="{{ route('storeRental', $rentalItem->id) }}" method="POST" id="orderForm">
            @csrf

            <!-- Hidden inputs untuk data yang sudah dipilih -->
            <input type="hidden" name="quantity" id="modalQuantityInput">
            <input type="hidden" name="start_date" id="modalStartDateInput">
            <input type="hidden" name="end_date" id="modalEndDateInput">

            <!-- Ringkasan pesanan -->
            <div class="bg-gray-50 p-4 rounded-lg mb-4">
                <h4 class="font-semibold text-gray-700 mb-2">{{ $rentalItem->name }}</h4>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span>Jumlah:</span>
                        <span id="modalQuantity">1</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Durasi:</span>
                        <span id="modalDays">1 Hari</span>
                    </div>
                    <div class="flex justify-between font-semibold">
                        <span>Total:</span>
                        <span id="modalTotalPrice">Rp 0</span>
                    </div>
                </div>
            </div>

            <!-- Form input tambahan -->
            <div class="space-y-4">
                <div>
                    <label for="delivery_location" class="block text-sm font-medium text-gray-700 mb-1">
                        Alamat Pengiriman
                    </label>
                    <textarea name="delivery_location" id="delivery_location" rows="3" required
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-sky-500 focus:border-transparent"
                        placeholder="Masukkan alamat lengkap untuk pengiriman...">{{ old('delivery_location') }}</textarea>
                    @error('delivery_location')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="payment_methods" class="block text-sm font-medium text-gray-700 mb-1">
                        Metode Pembayaran
                    </label>
                    <select name="payment_methods" id="payment_methods" required
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                        <option value="">Pilih metode pembayaran</option>
                        <option value="cash" {{ old('payment_methods') == 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="transfer" {{ old('payment_methods') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                        <option value="ewallet" {{ old('payment_methods') == 'ewallet' ? 'selected' : '' }}>E-Wallet</option>
                    </select>
                    @error('payment_methods')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                        Catatan (Opsional)
                    </label>
                    <textarea name="notes" id="notes" rows="2"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-sky-500 focus:border-transparent"
                        placeholder="Tambahkan catatan jika diperlukan...">{{ old('notes') }}</textarea>
                </div>
            </div>

            <!-- Tombol aksi -->
            <div class="flex gap-3 mt-6">
                <button type="button" onclick="closeBookingModal()"
                    class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400 transition-colors">
                    Batal
                </button>
                <button type="submit"
                    class="flex-1 bg-gradient-to-r from-sky-500 to-blue-500 text-white py-2 rounded-lg hover:from-sky-600 hover:to-blue-600 transition-colors">
                    Konfirmasi Pesanan
                </button>
            </div>
        </form>
    </div>
</div>


