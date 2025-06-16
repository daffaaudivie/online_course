@extends('layouts.user')

@section('content')
<main class="flex-1 py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Kursus Favorit Anda</h2>

            <div class="overflow-x-auto shadow-lg rounded-lg">
                <table class="min-w-full bg-white">
                    <thead class="bg-gradient-to-r from-rose-600 to-pink-700 text-white">
                        <tr>
                            <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">Link</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">Aksi</th>
                        </tr>
                </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($favoriteCourses as $index => $course)
                        <tr class="hover:bg-gray-50 transition-colors duration-200 {{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <div class="font-medium truncate max-w-xs" title="{{ $course->judul }}">
                                    {{ $course->judul }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center align-middle whitespace-nowrap">
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-700">
                                    {{ $course->kategori }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center align-middle whitespace-nowrap text-sm">
                                <a href="{{ $course->link }}" 
                                   target="_blank" 
                                   class="inline-flex items-center px-4 py-2 bg-slate-600 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                    Buka Course
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <form action="{{ route('favorites.destroy', $course->id_online_course) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="group relative inline-flex items-center justify-center w-10 h-10 bg-gradient-to-r from-pink-500 to-red-500 hover:from-pink-600 hover:to-red-600 text-white rounded-full transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-110"
                                            title="Hapus dari Favorit">
                                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-8 text-gray-500 text-sm">Belum ada course favorit.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($favoriteCourses, 'links'))
            <div class="mt-6">
                {{ $favoriteCourses->links() }}
            </div>
            @endif
        </div>
    </div>
</main>
@endsection
