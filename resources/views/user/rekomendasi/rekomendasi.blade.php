    @extends('layouts.user')

    @section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <!-- Header -->
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 rounded-t-lg">
                <h2 class="text-lg font-medium text-gray-800 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z"></path>
                    </svg>
                    Sistem Rekomendasi
                </h2>
            </div>

            <!-- Content -->
            <div class="p-6">
                <!-- Intro Text -->
                <div class="mb-6">
                    <h3 class="text-base font-medium text-gray-700 mb-2">Halaman Utama</h3>
                    <p class="text-sm text-gray-600">Masukkan nilai preferensi spesifikasi Online Course yang Anda inginkan</p>
                </div>

                <!-- Form -->
                <form action="{{ route('rekomendasi.proses') }}" method="POST" class="space-y-6" id="recommendationForm">
                    @csrf
                    
                    <!-- Grid Form -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kategori -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <select name="kategori" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                                <option value="">Pilih Kategori</option>
                                @foreach($kategori as $k)
                                    <option value="{{ $k }}" {{ old('kategori', request('kategori')) == $k ? 'selected' : '' }}>{{ $k }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Harga -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                            <select name="harga" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                                <option value="">Pilih Harga</option>
                                <option value="0" {{ old('harga', request('harga')) == '0' ? 'selected' : '' }}>Course Gratis</option>
                                <option value="100000" {{ old('harga', request('harga')) == '100000' ? 'selected' : '' }}>< Rp 100.000</option>
                                <option value="500000" {{ old('harga', request('harga')) == '500000' ? 'selected' : '' }}>< Rp 500.000</option>
                                <option value="1000000" {{ old('harga', request('harga')) == '1000000' ? 'selected' : '' }}>< Rp 1.000.000</option>
                            </select>
                        </div>

                        <!-- Rating -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                            <select name="rating" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                                <option value="">Pilih Rating</option>
                                <option value="1.0-1.5" {{ old('rating', request('rating')) == '1.0-4.5' ? 'selected' : '' }}>1.0 - 1.5</option>
                                <option value="1.5-2.0" {{ old('rating', request('rating')) == '1.5-2.0' ? 'selected' : '' }}>1.5 - 2.0</option>
                                <option value="2.0-2.5" {{ old('rating', request('rating')) == '2.0-2.5' ? 'selected' : '' }}>2.0 - 2.5</option>
                                <option value="2.5-3-0" {{ old('rating', request('rating')) == '2.5-3-0' ? 'selected' : '' }}>2.5 - 3-0</option>
                                <option value="3.0-3.5" {{ old('rating', request('rating')) == '3.0-3.5' ? 'selected' : '' }}>3.0 - 3.5</option>
                                <option value="3.5-4.0" {{ old('rating', request('rating')) == '3.5-4.0' ? 'selected' : '' }}>3.5 - 4.0</option>
                                <option value="4.0-4.5" {{ old('rating', request('rating')) == '4.0-4.5' ? 'selected' : '' }}>4.0 - 4.5</option>
                                <option value="4.5-5.0" {{ old('rating', request('rating')) == '4.5-5.0' ? 'selected' : '' }}>4.5 - 5.0</option>
                            </select>
                        </div>

                        <!-- Jumlah Viewers -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Viewers</label>
                            <select name="viewers" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                                <option value="">Pilih Jumlah Viewers</option>
                                <option value="1-10000" {{ old('viewers', request('viewers')) == '1-10000' ? 'selected' : '' }}>1 - 10.000</option>
                                <option value="10001-50000" {{ old('viewers', request('viewers')) == '10001-50000' ? 'selected' : '' }}>10.001 - 50.000</option>
                                <option value="50001" {{ old('viewers', request('viewers')) == '50001' ? 'selected' : '' }}>> 50.000</option>
                            </select>
                        </div>


                        <!-- Bahasa -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Bahasa</label>
                            <select name="bahasa" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                                <option value="">Pilih Bahasa</option>
                                @foreach($bahasa as $b)
                                    <option value="{{ $b }}" {{ old('bahasa', request('bahasa')) == $b ? 'selected' : '' }}>{{ $b }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tipe Course -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Course</label>
                            <select name="tipe" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                                <option value="">Pilih Tipe Course</option>
                                @foreach($tipe as $t)
                                    <option value="{{ $t }}" {{ old('tipe', request('tipe')) == $t ? 'selected' : '' }}>{{ $t }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Durasi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Durasi</label>
                            <select name="durasi" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                                <option value="">Pilih Durasi</option>
                                <option value="< 1 bulan" {{ old('durasi', request('durasi')) == '< 1 bulan' ? 'selected' : '' }}>0 - 1 Bulan</option>
                                <option value="1-6 bulan" {{ old('durasi', request('durasi')) == '1-6 bulan' ? 'selected' : '' }}>1 - 6 Bulan</option>
                                <option value="> 6 bulan" {{ old('durasi', request('durasi')) == '> 6 bulan' ? 'selected' : '' }}>> 6 Bulan</option>
                            </select>
                        </div>

                        <!-- Tingkat Kesulitan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tingkat Kesulitan</label>
                            <select name="level" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                                <option value="">Pilih Tingkat Kesulitan</option>
                                @foreach($level as $l)
                                    <option value="{{ $l }}" {{ old('level', request('level')) == $l ? 'selected' : '' }}>{{ $l }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Platform Course -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Platform Course</label>
                            <select name="platform" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                                <option value="">Pilih Platform</option>
                                @foreach($platform as $p)
                                    <option value="{{ $p }}" {{ old('platform', request('platform')) == $p ? 'selected' : '' }}>{{ $p }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center pt-4">
                        <button type="submit" class="px-8 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            Cari Rekomendasi
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Hasil Rekomendasi -->

       @isset($rekomendasi)
        <div class="mt-8 bg-white rounded-lg shadow-sm border border-gray-200" id="hasilRekomendasi">
            <!-- Header Hasil -->
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 rounded-t-lg">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Hasil Rekomendasi Course
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">Ditemukan {{ count($rekomendasi) }} course yang sesuai dengan preferensi Anda</p>
                    </div>
                    
                    <!-- Tombol Simpan Rekomendasi di pojok kanan atas -->
                    @auth
                        <form method="POST" action="{{ route('rekomendasi.simpan') }}">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                Simpan Rekomendasi
                            </button>
                        </form>
                    @endauth
                </div>
            </div>

            <!-- Tabel Hasil dengan kolom yang disesuaikan -->
            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 table-fixed">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="w-16 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Rank
                            </th>
                            <th class="w-80 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Judul Course
                            </th>
                            <th class="w-32 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kategori
                            </th>
                            <th class="w-32 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Platform
                            </th>
                            <th class="w-20 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Skor
                            </th>
                            <th class="w-40 px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($rekomendasi->values() as $i => $course)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center justify-center">
                                    @if($i < 3)
                                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full text-xs font-bold text-white 
                                            {{ $i == 0 ? 'bg-yellow-500' : ($i == 1 ? 'bg-gray-400' : 'bg-yellow-600') }}">
                                            {{ $i + 1 }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-800 text-xs font-medium">
                                            {{ $i + 1 }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900 break-words" title="{{ $course['judul'] }}">
                                    {{ $course['judul'] }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $course['kategori'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $course['platform'] ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="text-sm font-semibold text-blue-700">
                                    {{ number_format($course['skor'] ?? 0, 2) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <div class="flex items-center justify-center space-x-3">
                                    <!-- Tombol Detail -->
                                    <button onclick="openModal({{ $i }})" 
                                            class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Detail
                                    </button>
                                    
                                    <!-- Tombol Favorit berbentuk Hati -->
                                    @php
                                        $isFavorited = auth()->check() && auth()->user()->favorites()->where('favorites.id_online_course',$course['id'])->exists();
                                    @endphp
                                    
                                    @if($isFavorited)
                                        <!-- Hapus dari Favorit -->
                                        <form action="{{ route('favorites.destroy', $course['id']) }}" method="POST" 
                                                class="inline form-favorite" 
                                                data-id="{{ $course['id'] }}"
                                                data-method="DELETE">
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
                                        <form action="{{ route('favorites.store', $course['id']) }}" method="POST" 
                                        class="inline form-favorite" 
                                        data-id="{{ $course['id'] }}"
                                        data-method="POST">
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
            <!-- Footer Tabel -->
            <div class="bg-gray-50 px-6 py-3 border-t border-gray-200 rounded-b-lg">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-700">
                        Menampilkan <span class="font-medium">{{ count($rekomendasi) }}</span> hasil rekomendasi
                    </p>
                    <div class="text-xs text-gray-500">
                        Skor : 0.0 - 5.0
                    </div>
                </div>
            </div>
        </div>
        @endisset
    </div>

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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto scroll to results section if recommendations exist
        @isset($rekomendasi)
            setTimeout(function() {
                document.getElementById('hasilRekomendasi').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }, 100);
        @endisset
    });
    </script>
    @endsection