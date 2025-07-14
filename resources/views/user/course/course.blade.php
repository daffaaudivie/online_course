@extends('layouts.user')

@section('content')
<main class="flex-1 py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Kursus Tersedia</h2>

            <!-- Search Bar -->
            <div class="mb-6">
                <form method="GET" action="{{ request()->url() }}" class="flex items-center space-x-4">
                    <div class="relative flex-1 max-w-md">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Cari kursus berdasarkan judul atau kategori..." 
                               class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-colors duration-200">
                    </div>
                    
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-slate-600 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Cari
                    </button>
                    
                    @if(request('search'))
                    <a href="{{ request()->url() }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Reset
                    </a>
                    @endif
                </form>
                
                @if(request('search'))
                <div class="mt-3 text-sm text-gray-600">
                    Hasil pencarian untuk: <span class="font-semibold text-gray-800">"{{ request('search') }}"</span>
                    <span class="text-gray-500">({{ $courses->total() ?? count($courses) }} hasil ditemukan)</span>
                </div>
                @endif
            </div>

            <div class="shadow-lg rounded-lg">
                <table class="min-w-full bg-white">
                    <thead class="bg-gradient-to-r from-slate-700 to-slate-800 text-white">
                        <tr>
                            <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">Link</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($courses as $index => $course)
                        <tr class="hover:bg-gray-50 transition-colors duration-200 {{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <div class="font-medium truncate max-w-xs" title="{{ $course->judul }}">
                                    @if(request('search'))
                                        {!! str_ireplace(request('search'), '<mark class="bg-yellow-200 px-1 rounded">' . request('search') . '</mark>', $course->judul) !!}
                                    @else
                                        {{ $course->judul }}
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center align-middle whitespace-nowrap">
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-700">
                                    @if(request('search'))
                                        {!! str_ireplace(request('search'), '<mark class="bg-yellow-200 px-1 rounded">' . request('search') . '</mark>', $course->kategori) !!}
                                    @else
                                        {{ $course->kategori }}
                                    @endif
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
                                <div class="flex items-center justify-center space-x-3">
                                    <!-- Tombol Detail - Fixed: no scale transform -->
                                    <button onclick="openModal({{ $index }})" 
                                            class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Detail
                                    </button>
                                    
                                    <!-- Tombol Favorit berbentuk Hati - Fixed: no scale transform -->
                                    @php
                                        $isFavorited = auth()->check() && auth()->user()->favorites()->where('favorites.id_online_course', $course->id_online_course)->exists();
                                    @endphp
                                    
                                    @if($isFavorited)
                                        <!-- Hapus dari Favorit -->
                                        <form action="{{ route('favorites.destroy', $course->id_online_course) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="group relative inline-flex items-center justify-center w-10 h-10 bg-gradient-to-r from-pink-500 to-red-500 hover:from-pink-600 hover:to-red-600 text-white rounded-full transition-colors duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-pink-400 focus:ring-opacity-50"
                                                    title="Hapus dari Favorit">
                                                <!-- Heart Icon Filled -->
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
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
                                        <form action="{{ route('favorites.store', $course->id_online_course) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                    class="group relative inline-flex items-center justify-center w-10 h-10 bg-gray-200 hover:bg-gradient-to-r hover:from-pink-500 hover:to-red-500 text-gray-500 hover:text-white rounded-full transition-all duration-300 shadow-md hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-pink-400 focus:ring-opacity-50"
                                                    title="Tambah ke Favorit">
                                                <!-- Heart Icon Outline -->
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center space-y-3">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.5-.81-6.213-2.16m11.213-4.498a7.962 7.962 0 01-2.268-.498M12 3a9 9 0 100 18 9 9 0 000-18z"></path>
                                    </svg>
                                    @if(request('search'))
                                        <p class="text-lg font-medium">Tidak ada kursus yang ditemukan</p>
                                        <p class="text-sm">Coba gunakan kata kunci yang berbeda atau <a href="{{ request()->url() }}" class="text-slate-600 hover:text-slate-800 underline">reset pencarian</a></p>
                                    @else
                                        <p class="text-lg font-medium">Belum ada kursus tersedia</p>
                                        <p class="text-sm">Kursus akan ditampilkan di sini ketika sudah tersedia</p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination jika ada -->
            @if(method_exists($courses, 'links'))
            <div class="mt-6">
                {{ $courses->appends(request()->query())->links() }}
            </div>
            @endif
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
// Data courses untuk modal - convert ke array biasa
const coursesData = {!! json_encode($courses->values()) !!};

function openModal(courseIndex) {
    const modal = document.getElementById('courseModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalBody = document.getElementById('modalBody');
    
    // Ambil course berdasarkan index
    const course = coursesData[courseIndex];
    
    if (course) {
        modalTitle.textContent = course.judul || 'Detail Course';
        modalBody.innerHTML = `
            <!-- Deskripsi -->
                ${course.deskripsi ? `
                <div class="">
                    <label class="block text-sm font-semibold text-slate-700 mb-3">Deskripsi Course</label>
                    <div class="bg-slate-50 p-4 rounded-lg border">
                        <p class="text-sm text-slate-700">${course.deskripsi}</p>
                    </div>
                </div>
                ` : ''}
        <div class="space-y-6">
                <!-- Informasi Utama -->

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Judul Course</label>
                            <p class="text-sm text-slate-900 bg-slate-50 p-3 rounded-lg border">${course.judul || '-'}</p>
                        </div>
                        
                        ${course.kategori ? `
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Kategori</label>
                            <p class="text-sm text-slate-900 bg-slate-50 p-3 rounded-lg border">${course.kategori}</p>
                        </div>
                        ` : ''}
                        
                        ${course.tipe ? `
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Tipe</label>
                            <p class="text-sm text-slate-900 bg-slate-50 p-3 rounded-lg border">${course.tipe}</p>
                        </div>
                        ` : ''}
                        
                        ${course.bahasa ? `
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Bahasa</label>
                            <p class="text-sm text-slate-900 bg-slate-50 p-3 rounded-lg border">${course.bahasa}</p>
                        </div>
                        ` : ''}
                        
                        ${course.level ? `
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Level</label>
                            <p class="text-sm text-slate-900 bg-slate-50 p-3 rounded-lg border">${course.level}</p>
                        </div>
                        ` : ''}
                    </div>
                    
                    <div class="space-y-4">
                        ${course.rating ? `
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Rating</label>
                            <div class="flex items-center bg-slate-50 p-3 rounded-lg border">
                                <div class="flex items-center">
                                    ${generateStars(parseFloat(course.rating))}
                                </div>
                                <span class="text-sm font-medium text-slate-700 ml-2">${parseFloat(course.rating).toFixed(1)}</span>
                            </div>
                        </div>
                        ` : ''}
                        
                        ${course.jumlah_viewers ? `
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Jumlah Viewers</label>
                            <p class="text-sm text-slate-900 bg-slate-50 p-3 rounded-lg border">
                                <span class="font-medium">${parseInt(course.jumlah_viewers).toLocaleString('id-ID')}</span> orang
                            </p>
                        </div>
                        ` : ''}
                        
                        ${course.durasi ? `
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Durasi</label>
                            <p class="text-sm text-slate-900 bg-slate-50 p-3 rounded-lg border flex items-center">
                                <svg class="w-4 h-4 mr-2 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                ${course.durasi}
                            </p>
                        </div>
                        ` : ''}
                        
                        ${course.platform ? `
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Platform</label>
                            <p class="text-sm text-slate-900 bg-slate-50 p-3 rounded-lg border">${course.platform}</p>
                        </div>
                        ` : ''}

                        ${course.harga ? `
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Harga Course</label>
                            <p class="text-sm text-slate-900 bg-slate-50 p-3 rounded-lg border">
                                <span class="font-semibold text-green-600">Rp ${parseInt(course.harga).toLocaleString('id-ID')}</span>
                            </p>
                        </div>
                        ` : ''}
                    </div>
                </div>
                
                
                <!-- Link Course -->
                <div class="border-t pt-4">
                    <label class="block text-sm font-semibold text-slate-700 mb-3">Akses Course</label>
                    <a href="${course.link || '#'}" target="_blank" 
                       class="inline-flex items-center px-4 py-3 bg-gradient-to-r from-slate-600 to-slate-700 hover:from-slate-700 hover:to-slate-800 text-white text-sm font-medium rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        Buka Course Sekarang
                    </a>
                </div>
            </div>
        `;
    }
    
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function generateStars(rating) {
    const fullStars = Math.floor(rating);
    const hasHalfStar = rating % 1 !== 0;
    const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
    
    let starsHtml = '';
    
    // Full stars
    for (let i = 0; i < fullStars; i++) {
        starsHtml += '<svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>';
    }
    
    // Half star
    if (hasHalfStar) {
        starsHtml += '<svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><defs><linearGradient id="half"><stop offset="50%" stop-color="currentColor"/><stop offset="50%" stop-color="#e5e7eb"/></linearGradient></defs><path fill="url(#half)" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>';
    }
    
    // Empty stars
    for (let i = 0; i < emptyStars; i++) {
        starsHtml += '<svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>';
    }
    
    return starsHtml;
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