
<!-- Footer -->
<footer class="bg-blue-500 text-white">
    <div class="max-w-7xl mx-auto px-4 py-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 text-center sm:text-left">

            <!-- Kolom 1 -->
            <div>
                <h2 class="text-lg font-semibold mb-2">Trip Smartly</h2>
                <p class="text-sm leading-relaxed">
                    Platform terpercaya untuk open trip dan sewa perlengkapan. Wujudkan petualangan impianmu.
                </p>
            </div>

            <!-- Kolom 2 -->
            <div>
                <h2 class="text-lg font-semibold mb-2">Product</h2>
                <ul class="text-sm space-y-1">
                    <li><a href="#" class="hover:text-yellow-400 transition">Open Trip</a></li>
                    <li><a href="#" class="hover:text-yellow-400 transition">Sewa Perlengkapan</a></li>
                </ul>
            </div>

            <!-- Kolom 3 -->
            <div>
                <h2 class="text-lg font-semibold mb-2">Informasi</h2>
                <ul class="text-sm space-y-1">
                    <li><a href="#" class="hover:text-yellow-400 transition">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-yellow-400 transition">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="hover:text-yellow-400 transition">Kebijakan Privasi</a></li>
                    <li><a href="#" class="hover:text-yellow-400 transition">FAQ</a></li>
                </ul>
            </div>

            <!-- Kolom 4 -->
            <div>
                <h2 class="text-lg font-semibold mb-2">Contact Us</h2>
                <ul class="text-sm space-y-1">
                    <li>Email: tripsmartly@example.com</li>
                    <li>No. Telp: +628***</li>
                    <li>Lokasi: Padang, Sumatera Barat</li>
                </ul>

                <!-- Sosial Media Icons -->
                <div class="flex justify-center sm:justify-start space-x-3 mt-4">
                    <a href="#" aria-label="Facebook"
                        class="p-2 rounded-full bg-blue-600 hover:bg-yellow-400 transition">
                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M22 12a10 10 0 10-11.5 9.9v-7h-2v-3h2v-2.3c0-2 1.2-3.1 3-3.1.9 0 1.8.1 1.8.1v2h-1c-1 0-1.3.6-1.3 1.2V12h2.6l-.4 3h-2.2v7A10 10 0 0022 12z" />
                        </svg>
                    </a>
                    <a href="#" aria-label="Instagram"
                        class="p-2 rounded-full bg-blue-600 hover:bg-yellow-400 transition">
                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M7 2C4.8 2 3 3.8 3 6v12c0 2.2 1.8 4 4 4h10c2.2 0 4-1.8 4-4V6c0-2.2-1.8-4-4-4H7zm0 2h10c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H7c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2zm5 3a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6zm4.5-.5a1 1 0 100 2 1 1 0 000-2z" />
                        </svg>
                    </a>
                    <a href="#" aria-label="WhatsApp"
                        class="p-2 rounded-full bg-blue-600 hover:bg-yellow-400 transition">
                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12.04 2a10 10 0 00-8.47 15.27l-1.07 3.93 4.02-1.05A10 10 0 1012.04 2zm0 2a8 8 0 110 16 8 8 0 010-16zm4.44 11.54c-.24-.12-1.44-.71-1.67-.79-.23-.08-.4-.12-.56.12-.16.24-.64.79-.78.95-.14.16-.29.18-.54.06-.24-.12-1.02-.38-1.94-1.21-.72-.64-1.2-1.43-1.34-1.67-.14-.24-.01-.37.11-.49.11-.11.24-.28.36-.42.12-.14.16-.24.24-.4.08-.16.04-.3-.02-.42-.06-.12-.56-1.34-.77-1.83-.2-.48-.4-.42-.56-.43-.16-.01-.3-.01-.46-.01-.16 0-.42.06-.64.3-.22.24-.85.83-.85 2.02s.87 2.35 1 2.52c.12.16 1.72 2.62 4.17 3.68.58.25 1.04.4 1.4.51.59.19 1.13.16 1.55.1.47-.07 1.44-.59 1.65-1.16.21-.56.21-1.05.15-1.16-.06-.11-.22-.18-.46-.3z" />
                        </svg>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <div class="bg-blue-600 text-center text-sm py-4">
        &copy; <span id="year"></span> Trip Smartly. All rights reserved.
    </div>
</footer>

<script>
    document.getElementById('year').textContent = new Date().getFullYear();
</script>
