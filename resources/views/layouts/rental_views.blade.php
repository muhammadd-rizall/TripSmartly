{{-- header --}}
@include('layouts.header')

{{-- Hero Section --}}
<section class="bg-sky-100 pt-28 pb-12">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-sky-700 mb-8">
            Tentukan Barang Rental Mu
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
        </form>
    </div>
</section>


{{-- Barang rental per paket --}}
