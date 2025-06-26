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
                            <option value="1.0-4.0" {{ old('rating', request('rating')) == '1.0-4.0' ? 'selected' : '' }}>1.0 - 4.0</option>
                            <option value="4.0-4.5" {{ old('rating', request('rating')) == '4.0-4.5' ? 'selected' : '' }}>4.0 - 4.5</option>
                            <option value="4.5-4.7" {{ old('rating', request('rating')) == '4.5-4.7' ? 'selected' : '' }}>4.5 - 4.7</option>
                            <option value="4.7-5.0" {{ old('rating', request('rating')) == '4.7-5.0' ? 'selected' : '' }}>4.7 - 5.0</option>
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
            <h3 class="text-lg font-medium text-gray-800 flex items-center">
                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Hasil Rekomendasi Course
            </h3>
            <p class="text-sm text-gray-600 mt-1">Ditemukan {{ count($rekomendasi) }} course yang sesuai dengan preferensi Anda</p>
        </div>

        <!-- Tabel Hasil -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Rank
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Judul Course
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kategori
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Platform
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Rating
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Harga
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Skor
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($rekomendasi->values() as $i => $course)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
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
                            <div class="text-sm font-medium text-gray-900 max-w-xs truncate" title="{{ $course['judul'] }}">
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
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="text-sm text-gray-900">{{ $course['rating'] ?? 'N/A' }}</span>
                                @if(isset($course['rating']))
                                    <svg class="w-4 h-4 ml-1 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            @if(isset($course['harga']) && $course['harga'] == 0)
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Gratis
                                </span>
                            @else
                                Rp {{ number_format($course['harga'] ?? 0, 0, ',', '.') }}
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-1 bg-gray-200 rounded-full h-2 mr-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ ($course['skor'] ?? 0) * 10 }}%"></div>
                                </div>
                                <span class="text-sm font-semibold text-blue-700">
                                    {{ number_format($course['skor'] ?? 0, 2) }}
                                </span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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

<style>
/* Custom scrollbar untuk tabel */
.overflow-x-auto::-webkit-scrollbar {
    height: 8px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 4px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Animasi untuk baris tabel */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

tbody tr {
    animation: fadeIn 0.3s ease-out;
}

/* Smooth scroll behavior */
html {
    scroll-behavior: smooth;
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