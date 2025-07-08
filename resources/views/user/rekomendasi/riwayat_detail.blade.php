@extends('layouts.user')

@section('content')
<main class="flex-1 py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Detail Rekomendasi</h2>
            
            <!-- Preferensi Section -->
            <p class="text-sm text-gray-600 mb-4">Preferensi yang digunakan:</p>
    <div class="bg-gray-50 border rounded p-4 mb-6">
        <pre class="text-sm text-gray-800">{{ json_encode(json_decode($history->filter), JSON_PRETTY_PRINT) }}</pre>
    </div>

            <!-- Hasil Rekomendasi -->
            <div class="overflow-hidden shadow-lg rounded-lg">
                <table class="min-w-full bg-white">
                    <thead class="bg-gradient-to-r from-slate-700 to-slate-800 text-white">
                        <tr>
                            <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">Skor</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">Link</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($history->details as $index => $detail)
                        <tr class="hover:bg-gray-50 transition-colors duration-200 {{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <div class="font-medium truncate max-w-xs" title="{{ $detail->course->judul }}">
                                    {{ $detail->course->judul }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center align-middle whitespace-nowrap">
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-700">
                                    {{ $detail->course->kategori }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center align-middle whitespace-nowrap">
                                <div class="flex items-center justify-center">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm font-semibold text-emerald-600">
                                            {{ number_format($detail->skor, 2) }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center align-middle whitespace-nowrap text-sm">
                                <a href="{{ $detail->course->link }}" 
                                   target="_blank" 
                                   class="inline-flex items-center px-4 py-2 bg-slate-600 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                    Buka Course
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <div class="flex items-center justify-center space-x-3">
                                    <!-- Tombol Detail -->
                                    <button onclick="openModal({{ $detail->course->id_online_course }})" 
                                            class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md transform hover:scale-105">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Detail
                                    </button>
                                    
                                    <!-- Tombol Favorit berbentuk Hati -->
                                    @php
                                        $isFavorited = auth()->check() && auth()->user()->favorites()->where('favorites.id_online_course', $detail->course->id_online_course)->exists();
                                    @endphp
                                    
                                    @if($isFavorited)
                                        <!-- Hapus dari Favorit -->
                                        <form action="{{ route('favorites.destroy', $detail->course->id_online_course) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="group relative inline-flex items-center justify-center w-10 h-10 bg-gradient-to-r from-pink-500 to-red-500 hover:from-pink-600 hover:to-red-600 text-white rounded-full transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:ring-opacity-50"
                                                    title="Hapus dari Favorit">
                                                <!-- Heart Icon Filled -->
                                                <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                                </svg>
                                                
                                                <!-- Animated Heart on Hover -->
                                                <div class="absolute inset-0 rounded-full bg-gradient-to-r from-pink-400 to-red-400 opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                                                
                                                <!-- Pulse Effect -->
                                                <div class="absolute inset-0 rounded-full bg-pink-400 animate-ping opacity-0 group-hover:opacity-30"></div>
                                            </button>
                                        </form>
                                    @else
                                        <!-- Tambah ke Favorit -->
                                        <form action="{{ route('favorites.store', $detail->course->id_online_course) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                    class="group relative inline-flex items-center justify-center w-10 h-10 bg-gray-200 hover:bg-gradient-to-r hover:from-pink-500 hover:to-red-500 text-gray-500 hover:text-white rounded-full transition-all duration-300 shadow-md hover:shadow-xl transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:ring-opacity-50"
                                                    title="Tambah ke Favorit">
                                                <!-- Heart Icon Outline -->
                                                <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                </svg>
                                                
                                                <!-- Animated Heart on Hover -->
                                                <div class="absolute inset-0 rounded-full bg-gradient-to-r from-pink-400 to-red-400 opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                                                
                                                <!-- Pulse Effect -->
                                                <div class="absolute inset-0 rounded-full bg-pink-400 animate-ping opacity-0 group-hover:opacity-30"></div>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Modal Detail Course -->
<div id="courseModal" class="fixed inset-0 bg-slate-900 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden backdrop-blur-sm">
    <div class="relative top-20 mx-auto p-5 border border-slate-200 w-11/12 md:w-3/4 lg:w-1/2 shadow-2xl rounded-xl bg-white">
        <div class="mt-3">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-gray-50 rounded-t-xl">
                <h3 class="text-xl font-semibold text-slate-800 flex items-center" id="modalTitle">
                    <svg class="w-6 h-6 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    Detail Course
                </h3>
                <button onclick="closeModal()" class="text-slate-400 bg-transparent hover:bg-slate-200 hover:text-slate-600 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center transition-colors duration-200">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Modal Body -->
            <div class="p-6 space-y-4 max-h-96 overflow-y-auto" id="modalBody">
                <div class="animate-pulse">
                    <div class="h-4 bg-slate-200 rounded w-3/4 mb-4"></div>
                    <div class="h-4 bg-slate-200 rounded w-full mb-2"></div>
                    <div class="h-4 bg-slate-200 rounded w-5/6"></div>
                </div>
            </div>
            
            <!-- Modal Footer -->
            <div class="flex items-center justify-end p-4 border-t border-slate-200 bg-gradient-to-r from-slate-50 to-gray-50 rounded-b-xl space-x-3">
                <button onclick="closeModal()" class="px-6 py-2 bg-slate-500 hover:bg-slate-600 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Data courses untuk modal
const coursesData = @json($history->details->pluck('course'));

function openModal(courseId) {
    const modal = document.getElementById('courseModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalBody = document.getElementById('modalBody');
    
    // Cari course berdasarkan ID
    const course = coursesData.find(c => c.id_online_course === courseId);
    
    if (course) {
        modalTitle.innerHTML = `
            <svg class="w-6 h-6 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
            ${course.judul}
        `;
        
        modalBody.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="bg-gradient-to-r from-slate-50 to-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-semibold text-slate-700 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h4a1 1 0 110 2h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6H3a1 1 0 110-2h4z"></path>
                            </svg>
                            Judul Course
                        </label>
                        <p class="text-sm text-slate-900 font-medium">${course.judul}</p>
                    </div>
                    
                    <div class="bg-gradient-to-r from-slate-50 to-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-semibold text-slate-700 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Kategori
                        </label>
                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-700">
                            ${course.kategori}
                        </span>
                    </div>
                    
                    ${course.tipe ? `
                    <div class="bg-gradient-to-r from-slate-50 to-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Tipe</label>
                        <p class="text-sm text-slate-900">${course.tipe}</p>
                    </div>
                    ` : ''}
                    
                    ${course.bahasa ? `
                    <div class="bg-gradient-to-r from-slate-50 to-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-semibold text-slate-700 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                            </svg>
                            Bahasa
                        </label>
                        <p class="text-sm text-slate-900">${course.bahasa}</p>
                    </div>
                    ` : ''}
                    
                    ${course.level ? `
                    <div class="bg-gradient-to-r from-slate-50 to-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-semibold text-slate-700 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Level
                        </label>
                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-700">
                            ${course.level}
                        </span>
                    </div>
                    ` : ''}
                </div>
                
                <div class="space-y-4">
                    ${course.rating ? `
                    <div class="bg-gradient-to-r from-slate-50 to-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-semibold text-slate-700 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                            </svg>
                            Rating
                        </label>
                        <div class="flex items-center">
                            <span class="text-yellow-500 text-lg mr-1">★</span>
                            <span class="text-sm font-medium text-slate-900">${parseFloat(course.rating).toFixed(1)}</span>
                        </div>
                    </div>
                    ` : ''}
                    
                    ${course.jumlah_viewers ? `
                    <div class="bg-gradient-to-r from-slate-50 to-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-semibold text-slate-700 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Jumlah Viewers
                        </label>
                        <p class="text-sm text-slate-900 font-medium">${course.jumlah_viewers.toLocaleString()}</p>
                    </div>
                    ` : ''}
                    
                    ${course.durasi ? `
                    <div class="bg-gradient-to-r from-slate-50 to-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-semibold text-slate-700 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Durasi
                        </label>
                        <p class="text-sm text-slate-900 font-medium">${course.durasi}</p>
                    </div>
                    ` : ''}
                    
                    ${course.platform ? `
                    <div class="bg-gradient-to-r from-slate-50 to-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-semibold text-slate-700 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Platform
                        </label>
                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-700">
                            ${course.platform}
                        </span>
                    </div>
                    ` : ''}
                    
                    ${course.deskripsi ? `
                    <div class="bg-gradient-to-r from-slate-50 to-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-semibold text-slate-700 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Deskripsi
                        </label>
                        <p class="text-sm text-slate-900 leading-relaxed">${course.deskripsi}</p>
                    </div>
                    ` : ''}
                    
                    <div class="bg-gradient-to-r from-slate-50 to-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            Link Course
                        </label>
                        <a href="${course.link}" target="_blank" 
                           class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-slate-600 to-slate-700 hover:from-slate-700 hover:to-slate-800 text-white text-sm font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md transform hover:scale-105">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            Buka Course
                        </a>
                    </div>
                </div>
            </div>
        `;
    }
    
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    const modal = document.getElementById('courseModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
document.getElementById('courseModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});

// Add some additional styling for better UX
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth scrolling to modal
    const modalBody = document.getElementById('modalBody');
    if (modalBody) {
        modalBody.style.scrollBehavior = 'smooth';
    }
    
    // Add click animation to favorite buttons
    const favoriteButtons = document.querySelectorAll('button[title*="Favorit"]');
    favoriteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            // Add clicked animation
            this.classList.add('heart-clicked');
            
            // Remove animation after it completes
            setTimeout(() => {
                this.classList.remove('heart-clicked');
            }, 300);
            
            // Optional: Show loading state
            const originalContent = this.innerHTML;
            this.innerHTML = `
                <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            `;
            
            // Restore original content after form submission
            setTimeout(() => {
                this.innerHTML = originalContent;
            }, 1000);
        });
    });
});

// Function to show success message (optional)
function showFavoriteMessage(isFavorited, courseTitle) {
    const message = isFavorited ? 
        `"${courseTitle}" ditambahkan ke favorit!` : 
        `"${courseTitle}" dihapus dari favorit!`;
    
    // Create toast notification (you can customize this)
    const toast = document.createElement('div');
    toast.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg text-white transform transition-all duration-300 ${
        isFavorited ? 'bg-green-500' : 'bg-orange-500'
    }`;
    toast.textContent = message;
    
    document.body.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.style.transform = 'translateX(0)';
    }, 100);
    
    // Remove after 3 seconds
    setTimeout(() => {
        toast.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300);
    }, 3000);
}
</script>

<style>
/* Custom scrollbar untuk modal */
#modalBody::-webkit-scrollbar {
    width: 6px;
}

#modalBody::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
}

#modalBody::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
}

#modalBody::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Animasi untuk tombol favorit */
@keyframes heartbeat {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

@keyframes heartPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.heart-animate:hover {
    animation: heartbeat 0.6s ease-in-out;
}

/* Animasi saat diklik */
.heart-clicked {
    animation: heartPulse 0.3s ease-in-out;
}

/* Transisi smooth untuk perubahan warna */
.heart-button {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
</style>

@endsection