@vite(['resources/css/app.css', 'resources/js/app.js'])
@include('layouts.header')

<div class="min-h-screen bg-gray-50 flex items-center justify-center py-20">
    <div class="bg-white rounded-2xl shadow-lg max-w-lg w-full p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Review {{ $type === 'trip' ? 'Trip' : 'Rental' }}</h2>
        <p class="text-gray-600 mb-6">
            {{ $type === 'trip' ? $order->rizal_trip->title : $order->rizal_rental_item->name }}
        </p>

        <form method="POST" action="{{ $type === 'trip' ? route('tripSubmit', $order->id) : route('rentalSubmit', $order->id) }}">
            @csrf

            <!-- Rating -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Rating</label>
                <div class="flex items-center space-x-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <label>
                            <input type="radio" name="rating" value="{{ $i }}" class="hidden" {{ old('rating') == $i ? 'checked' : '' }}>
                            <svg class="w-8 h-8 cursor-pointer {{ old('rating') >= $i ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.388 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.388-2.46a1 1 0 00-1.175 0l-3.388 2.46c-.784.57-1.838-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.045 9.394c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.967z"/>
                            </svg>
                        </label>
                    @endfor
                </div>
                @error('rating')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Comment -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Your Review</label>
                <textarea name="comment" rows="4" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">{{ old('comment') }}</textarea>
                @error('comment')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Submit Review</button>
            </div>
        </form>
    </div>
</div>
