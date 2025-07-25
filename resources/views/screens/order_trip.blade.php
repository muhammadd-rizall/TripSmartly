<div id="bookingModal" class="fixed inset-0 z-50 hidden bg-black/50 items-center justify-center">

    <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6 relative">
        <button type="button" onclick="closeBookingModal()"
            class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>

        <h3 class="text-xl font-bold mb-4 text-sky-600">Konfirmasi Pemesanan</h3>

        <form action="{{ route('tripStore', $openTrip->id) }}" method="POST" class="space-y-4">
            @csrf

            <div class="flex justify-between items-center">
                <span class="text-gray-700 font-medium">Jumlah Partisipan</span>
                <span id="modalParticipants" class="font-bold text-gray-800">1</span>
            </div>

            <div class="flex justify-between items-center">
                <span class="text-gray-700 font-medium">Total Harga</span>
                <span id="modalTotalPrice" class="font-bold text-sky-600">Rp 0</span>
            </div>

            <hr class="my-3">

            <div>
                <label class="block text-gray-700 font-medium mb-1">Metode Pembayaran</label>
                <select name="payment_methods" required
                    class="w-full border-gray-300 rounded-lg focus:ring-sky-500 focus:border-sky-500">
                    <option value="" disabled selected>Pilih Metode</option>
                    <option value="transfer">Transfer Bank</option>
                    <option value="qris">QRIS</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Catatan</label>
                <textarea name="special_request" rows="3"
                    class="w-full border-gray-300 rounded-lg focus:ring-sky-500 focus:border-sky-500"
                    placeholder="Tambahkan catatan (opsional)"></textarea>
            </div>

            <input type="hidden" id="modalParticipantsInput" name="participants">

            <button type="submit"
                class="w-full bg-sky-500 text-white py-3 rounded-lg font-semibold hover:bg-sky-600 transition-colors">
                Konfirmasi & Pesan
            </button>
        </form>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', () => {
        const openModalButton = document.getElementById('openModalButton');
        const bookingModal = document.getElementById('bookingModal');
        const participantsInput = document.getElementById('participants');
        const totalPriceDisplay = document.getElementById('totalPriceDisplay');

        const modalParticipants = document.getElementById('modalParticipants');
        const modalTotalPrice = document.getElementById('modalTotalPrice');
        const modalParticipantsInput = document.getElementById('modalParticipantsInput');

        openModalButton.addEventListener('click', () => {
            // Ambil nilai dari form luar
            const participants = participantsInput.value;
            const totalPrice = totalPriceDisplay.textContent;

            // Tampilkan ke modal
            modalParticipants.textContent = participants;
            modalTotalPrice.textContent = totalPrice;
            modalParticipantsInput.value = participants;

            // Tampilkan modal
            bookingModal.classList.remove('hidden');
            bookingModal.classList.add('flex');
        });
    });

    function closeBookingModal() {
        const bookingModal = document.getElementById('bookingModal');
        bookingModal.classList.add('hidden');
        bookingModal.classList.remove('flex');
    }
</script>
