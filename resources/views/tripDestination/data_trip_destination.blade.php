@extends('admins.dashboard')
@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Data Trip Destination</h1>

        <a href="{{ route('createTD') }}"
            class="inline-block mb-6 bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-md shadow transition duration-200">
            Tambah Trip Destination
        </a>

        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-[1400px] w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-blue-50 text-gray-700 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-4 py-3 text-center font-bold">No</th>
                        <th class="px-4 py-3 text-center font-bold">Nama Trip</th>
                        <th class="px-6 py-3 text-center font-bold">Nama Destinasi</th>
                        <th class="px-4 py-3 text-center font-bold">Deskripsi</th>
                        <th class="px-4 py-3 text-center min-w-[200px] font-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach ($tds as $index => $td)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-4 py-4 text-center font-medium text-gray-900">
                                {{ $index + $tds->firstItem() }}
                            </td>
                            <td class="px-4 py-4 text-center text-gray-900">
                                {{ $td->rizal_trip->title}}
                            </td>
                            <td class="px-4 py-4">
                                <div class="space-y-1">
                                    @foreach (explode(',', $td->place_name) as $place)
                                        <div class="flex items-start">
                                            <span class="text-green-500 mr-2">•</span>
                                            <span class="text-gray-700 text-xs">{{ trim($place) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-4 py-4 text-gray-700 max-w-xs">
                                <div class="line-clamp-3">{{ $td->description }}</div>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <div class="flex justify-center gap-2 flex-wrap">
                                    <a href="#"
                                        class="inline-flex items-center bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-md text-xs font-medium transition duration-150 shadow-sm">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        Show
                                    </a>
                                    <a href="{{ route('editTD' ,$td->id) }}"
                                        class="inline-flex items-center bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded-md text-xs font-medium transition duration-150 shadow-sm">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{route('destroyTD', $td->id) }}" method="POST" class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete this trip?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-md text-xs font-medium transition duration-150 shadow-sm">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-center">
            {{ $tds->links() }}
        </div>
    </div>
@endsection
