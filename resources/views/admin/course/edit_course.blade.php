@extends('layouts.admin')

@section('content')
<main class="flex-1 ml-64 py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Data Online Course</h2>

            {{-- Manual Input Form --}}
            <div id="manual-content" class="tab-content">
                <form action="{{ route('course.update', $course->id_online_course) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Judul --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Judul</label>
                        <input type="text" name="judul" value="{{ old('judul', $course->judul) }}" 
                               class="w-full border border-gray-300 rounded p-2 @error('judul') border-red-500 @enderror" required>
                        @error('judul')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-1">Deskripsi</label>
                        <textarea name="deskripsi" rows="4" 
                                  class="w-full border border-gray-300 rounded p-2 @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $course->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Grid Input --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Kategori --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Kategori</label>
                            <input type="text" name="kategori" value="{{ old('kategori', $course->kategori) }}" 
                                   class="w-full border border-gray-300 rounded p-2 @error('kategori') border-red-500 @enderror" 
                                   placeholder="Contoh: Data Analis">
                            @error('kategori')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Harga --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Harga</label>
                            <input type="text" name="harga" value="{{ old('harga', $course->harga) }}" 
                                   class="w-full border border-gray-300 rounded p-2 @error('harga') border-red-500 @enderror" 
                                   placeholder="Contoh: Gratis / Berbayar">
                            @error('harga')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Rating --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Rating</label>
                            <input type="number" step="0.1" max="5" name="rating" value="{{ old('rating', $course->rating) }}" 
                                   class="w-full border border-gray-300 rounded p-2 @error('rating') border-red-500 @enderror" 
                                   placeholder="Contoh: 4.5">
                            @error('rating')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Jumlah Viewers --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Jumlah Viewers</label>
                            <input type="number" name="jumlah_viewers" value="{{ old('jumlah_viewers', $course->jumlah_viewers) }}" 
                                   class="w-full border border-gray-300 rounded p-2 @error('jumlah_viewers') border-red-500 @enderror" 
                                   placeholder="Contoh: 5000">
                            @error('jumlah_viewers')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Bahasa --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Bahasa</label>
                            <select name="bahasa" class="w-full border border-gray-300 rounded p-2 @error('bahasa') border-red-500 @enderror">
                                <option value="Indonesia" {{ old('bahasa', $course->bahasa) == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                <option value="Inggris" {{ old('bahasa', $course->bahasa) == 'Inggris' ? 'selected' : '' }}>Inggris</option>
                            </select>
                            @error('bahasa')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tipe Course --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Tipe Course</label>
                            <select name="tipe" class="w-full border border-gray-300 rounded p-2 @error('tipe') border-red-500 @enderror">
                                <option value="">-- Pilih Tipe --</option>
                                <option value="Specialization" {{ old('tipe', $course->tipe) == 'Specialization' ? 'selected' : '' }}>Specialization</option>
                                <option value="Professional Certificate" {{ old('tipe', $course->tipe) == 'Professional Certificate' ? 'selected' : '' }}>Professional Certificate</option>
                                <option value="Guided Project" {{ old('tipe', $course->tipe) == 'Guided Project' ? 'selected' : '' }}>Guided Project</option>
                            </select>
                            @error('tipe')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Durasi --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Durasi</label>
                            <select name="durasi" class="w-full border border-gray-300 rounded p-2 @error('durasi') border-red-500 @enderror">
                                <option value="0-3 Bulan" {{ old('durasi', $course->durasi) == '0-3 Bulan' ? 'selected' : '' }}>0-3 Bulan</option>
                                <option value="4-6 Bulan" {{ old('durasi', $course->durasi) == '4-6 Bulan' ? 'selected' : '' }}>4-6 Bulan</option>
                                <option value="> 6 Bulan" {{ old('durasi', $course->durasi) == '> 6 Bulan' ? 'selected' : '' }}>> 6 Bulan</option>
                            </select>
                            @error('durasi')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Level --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Tingkat Kesulitan</label>
                            <select name="level" class="w-full border border-gray-300 rounded p-2 @error('level') border-red-500 @enderror">
                                <option value="Pemula" {{ old('level', $course->level) == 'Pemula' ? 'selected' : '' }}>Pemula</option>
                                <option value="Menengah" {{ old('level', $course->level) == 'Menengah' ? 'selected' : '' }}>Menengah</option>
                                <option value="Lanjutan" {{ old('level', $course->level) == 'Lanjutan' ? 'selected' : '' }}>Lanjutan</option>
                            </select>
                            @error('level')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Platform --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Platform</label>
                            <select name="platform" class="w-full border border-gray-300 rounded p-2 @error('platform') border-red-500 @enderror">
                                <option value="Coursera" {{ old('platform', $course->platform) == 'Coursera' ? 'selected' : '' }}>Coursera</option>
                                <option value="edX" {{ old('platform', $course->platform) == 'edX' ? 'selected' : '' }}>edX</option>
                                <option value="Udemy" {{ old('platform', $course->platform) == 'Udemy' ? 'selected' : '' }}>Udemy</option>
                            </select>
                            @error('platform')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Link --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Link Course</label>
                            <input type="url" name="link" value="{{ old('link', $course->link) }}" 
                                   class="w-full border border-gray-300 rounded p-2 @error('link') border-red-500 @enderror" required>
                            @error('link')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end mt-8">
                        <a href="{{ route('course.index') }}"
                           class="px-4 py-2 bg-gray-300 text-gray-800 rounded mr-2 hover:bg-gray-400">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700">
                            Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection