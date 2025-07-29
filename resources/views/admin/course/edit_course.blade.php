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
                               class="w-full border border-gray-300 rounded p-2 @error('judul') border-red-500 @enderror" required
                               oninvalid="this.setCustomValidity('Please fill out this field')" 
                               oninput="this.setCustomValidity('')">
                        @error('judul')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-1">Deskripsi</label>
                        <textarea name="deskripsi" rows="4" 
                                  class="w-full border border-gray-300 rounded p-2 @error('deskripsi') border-red-500 @enderror" required
                                  oninvalid="this.setCustomValidity('Please fill out this field')" 
                                  oninput="this.setCustomValidity('')">{{ old('deskripsi', $course->deskripsi) }}</textarea>
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
                                   placeholder="Contoh: Data Science" required
                                   oninvalid="this.setCustomValidity('Please fill out this field')" 
                                   oninput="this.setCustomValidity('')">
                            @error('kategori')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Harga --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Harga (Rp)</label>
                            <input type="number" name="harga" value="{{ old('harga', $course->harga) }}" 
                                   class="w-full border border-gray-300 rounded p-2 @error('harga') border-red-500 @enderror" 
                                   placeholder="500000" min="0" required
                                   oninvalid="this.setCustomValidity('Please fill out this field')" 
                                   oninput="this.setCustomValidity('')">
                            <small class="text-gray-500">Masukkan angka saja (tanpa titik atau koma)</small>
                            @error('harga')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Rating --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Rating</label>
                            <input type="number" step="0.1" max="5" min="0" name="rating" value="{{ old('rating', $course->rating) }}" 
                                   class="w-full border border-gray-300 rounded p-2 @error('rating') border-red-500 @enderror" 
                                   placeholder="Contoh: 1.0-5.0" required
                                   oninvalid="this.setCustomValidity('Please fill out this field')" 
                                   oninput="this.setCustomValidity('')">
                            <small class="text-gray-500">Tambahkan titik diantara nomor</small>
                            @error('rating')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Jumlah Viewers --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Jumlah Viewers</label>
                            <input type="number" name="jumlah_viewers" value="{{ old('jumlah_viewers', $course->jumlah_viewers) }}" 
                                   class="w-full border border-gray-300 rounded p-2 @error('jumlah_viewers') border-red-500 @enderror" 
                                   placeholder="5000" min="0" required
                                   oninvalid="this.setCustomValidity('Please fill out this field')" 
                                   oninput="this.setCustomValidity('')">
                            <small class="text-gray-500">Masukkan angka saja (tanpa titik atau koma)</small>
                            @error('jumlah_viewers')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Bahasa --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Bahasa</label>
                            <select id="bahasa-dropdown" name="bahasa" class="w-full border border-gray-300 rounded p-2 @error('bahasa') border-red-500 @enderror" required
                                    oninvalid="this.setCustomValidity('Please select an option')" 
                                    onchange="handleBahasaChange(this)">
                                <option value="">Pilih Bahasa</option>
                                <option value="Indonesia" {{ old('bahasa', $course->bahasa) == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                <option value="English" {{ old('bahasa', $course->bahasa) == 'English' ? 'selected' : '' }}>English</option>
                                <option value="Mandarin" {{ old('bahasa', $course->bahasa) == 'Mandarin' ? 'selected' : '' }}>Mandarin</option>
                                <option value="Spanish" {{ old('bahasa', $course->bahasa) == 'Spanish' ? 'selected' : '' }}>Spanish</option>
                                <option value="French" {{ old('bahasa', $course->bahasa) == 'French' ? 'selected' : '' }}>French</option>
                                <option value="German" {{ old('bahasa', $course->bahasa) == 'German' ? 'selected' : '' }}>German</option>
                                <option value="Japanese" {{ old('bahasa', $course->bahasa) == 'Japanese' ? 'selected' : '' }}>Japanese</option>
                                <option value="Korean" {{ old('bahasa', $course->bahasa) == 'Korean' ? 'selected' : '' }}>Korean</option>
                                <option value="Arabic" {{ old('bahasa', $course->bahasa) == 'Arabic' ? 'selected' : '' }}>Arabic</option>
                                <option value="Portuguese" {{ old('bahasa', $course->bahasa) == 'Portuguese' ? 'selected' : '' }}>Portuguese</option>
                                <option value="Russian" {{ old('bahasa', $course->bahasa) == 'Russian' ? 'selected' : '' }}>Russian</option>
                                <option value="Italian" {{ old('bahasa', $course->bahasa) == 'Italian' ? 'selected' : '' }}>Italian</option>
                                <option value="other" {{ !in_array(old('bahasa', $course->bahasa), ['Indonesia', 'English', 'Mandarin', 'Spanish', 'French', 'German', 'Japanese', 'Korean', 'Arabic', 'Portuguese', 'Russian', 'Italian']) && old('bahasa', $course->bahasa) != '' ? 'selected' : '' }}>Lainnya (Tulis Sendiri)</option>
                            </select>
                            <input type="text" id="bahasa-custom" placeholder="Masukkan bahasa lainnya..." 
                                   class="w-full border border-gray-300 rounded p-2 mt-2 {{ !in_array(old('bahasa', $course->bahasa), ['Indonesia', 'English', 'Mandarin', 'Spanish', 'French', 'German', 'Japanese', 'Korean', 'Arabic', 'Portuguese', 'Russian', 'Italian']) && old('bahasa', $course->bahasa) != '' ? '' : 'hidden' }}"
                                   value="{{ !in_array(old('bahasa', $course->bahasa), ['Indonesia', 'English', 'Mandarin', 'Spanish', 'French', 'German', 'Japanese', 'Korean', 'Arabic', 'Portuguese', 'Russian', 'Italian']) && old('bahasa', $course->bahasa) != '' ? old('bahasa', $course->bahasa) : '' }}"
                                   oninvalid="this.setCustomValidity('Please fill out this field')" 
                                   oninput="this.setCustomValidity('')">
                            @error('bahasa')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tipe Course --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Tipe Course</label>
                            <select id="tipe-dropdown" name="tipe" class="w-full border border-gray-300 rounded p-2 @error('tipe') border-red-500 @enderror" required
                                    oninvalid="this.setCustomValidity('Please select an option')" 
                                    onchange="handleTipeChange(this)">
                                <option value="">Pilih Tipe Course</option>
                                <option value="Course" {{ old('tipe', $course->tipe) == 'Course' ? 'selected' : '' }}>Course</option>
                                <option value="Specialization" {{ old('tipe', $course->tipe) == 'Specialization' ? 'selected' : '' }}>Specialization</option>
                                <option value="Professional Certificate" {{ old('tipe', $course->tipe) == 'Professional Certificate' ? 'selected' : '' }}>Professional Certificate</option>
                                <option value="Guided Project" {{ old('tipe', $course->tipe) == 'Guided Project' ? 'selected' : '' }}>Guided Project</option>
                                <option value="Tutorial" {{ old('tipe', $course->tipe) == 'Tutorial' ? 'selected' : '' }}>Tutorial</option>
                                <option value="Workshop" {{ old('tipe', $course->tipe) == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                                <option value="other" {{ !in_array(old('tipe', $course->tipe), ['Course', 'Specialization', 'Professional Certificate', 'Guided Project', 'Tutorial', 'Workshop']) && old('tipe', $course->tipe) != '' ? 'selected' : '' }}>Lainnya (Tulis Sendiri)</option>
                            </select>
                            <input type="text" id="tipe-custom" placeholder="Masukkan tipe course lainnya..." 
                                   class="w-full border border-gray-300 rounded p-2 mt-2 {{ !in_array(old('tipe', $course->tipe), ['Course', 'Specialization', 'Professional Certificate', 'Guided Project', 'Tutorial', 'Workshop']) && old('tipe', $course->tipe) != '' ? '' : 'hidden' }}"
                                   value="{{ !in_array(old('tipe', $course->tipe), ['Course', 'Specialization', 'Professional Certificate', 'Guided Project', 'Tutorial', 'Workshop']) && old('tipe', $course->tipe) != '' ? old('tipe', $course->tipe) : '' }}"
                                   oninvalid="this.setCustomValidity('Please fill out this field')" 
                                   oninput="this.setCustomValidity('')">
                            @error('tipe')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Durasi --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Durasi</label>
                            <div class="flex gap-2">
                                <input type="number" id="durasi_angka" class="flex-1 border border-gray-300 rounded p-2" 
                                       placeholder="6" min="1" required
                                       value="{{ old('durasi_angka', explode(' ', $course->durasi)[0] ?? '') }}"
                                       oninvalid="this.setCustomValidity('Please fill out this field')" 
                                       oninput="this.setCustomValidity(''); updateDurasi()">
                                <select id="durasi_satuan" class="flex-1 border border-gray-300 rounded p-2" required
                                        onchange="updateDurasi()">
                                    <option value="">Pilih Satuan</option>
                                    <option value="days" {{ old('durasi_satuan', explode(' ', $course->durasi)[1] ?? '') == 'days' ? 'selected' : '' }}>Hari</option>
                                    <option value="weeks" {{ old('durasi_satuan', explode(' ', $course->durasi)[1] ?? '') == 'weeks' ? 'selected' : '' }}>Minggu</option>
                                    <option value="months" {{ old('durasi_satuan', explode(' ', $course->durasi)[1] ?? '') == 'months' ? 'selected' : '' }}>Bulan</option>
                                </select>
                            </div>
                            <input type="hidden" name="durasi" id="durasi_hidden" value="{{ old('durasi', $course->durasi) }}">
                            <small class="text-gray-500">Contoh: 6 Bulan akan tersimpan sebagai "6 months"</small>
                            @error('durasi')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Level --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Tingkat Kesulitan</label>
                            <select name="level" class="w-full border border-gray-300 rounded p-2 @error('level') border-red-500 @enderror" required
                                    oninvalid="this.setCustomValidity('Please select an option')" 
                                    onchange="this.setCustomValidity('')">
                                <option value="">Pilih Tingkat Kesulitan</option>
                                <option value="Beginner" {{ old('level', $course->level) == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                <option value="Intermediate" {{ old('level', $course->level) == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="Advanced" {{ old('level', $course->level) == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                                <option value="Unknown" {{ old('level', $course->level) == 'Unknown' ? 'selected' : '' }}>Unknown</option>
                            </select>
                            @error('level')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Platform --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Platform</label>
                            <select id="platform-dropdown" name="platform" class="w-full border border-gray-300 rounded p-2 @error('platform') border-red-500 @enderror" required
                                    oninvalid="this.setCustomValidity('Please select an option')" 
                                    onchange="handlePlatformChange(this)">
                                <option value="">Pilih Platform</option>
                                <option value="Coursera" {{ old('platform', $course->platform) == 'Coursera' ? 'selected' : '' }}>Coursera</option>
                                <option value="Udemy" {{ old('platform', $course->platform) == 'Udemy' ? 'selected' : '' }}>Udemy</option>
                                <option value="edX" {{ old('platform', $course->platform) == 'edX' ? 'selected' : '' }}>edX</option>
                                <option value="Udacity" {{ old('platform', $course->platform) == 'Udacity' ? 'selected' : '' }}>Udacity</option>
                                <option value="Codecademy" {{ old('platform', $course->platform) == 'Codecademy' ? 'selected' : '' }}>Codecademy</option>
                                <option value="FutureLearn" {{ old('platform', $course->platform) == 'FutureLearn' ? 'selected' : '' }}>FutureLearn</option>
                                <option value="other" {{ !in_array(old('platform', $course->platform), ['Coursera', 'Udemy', 'edX', 'Udacity', 'Codecademy', 'FutureLearn']) && old('platform', $course->platform) != '' ? 'selected' : '' }}>Lainnya (Tulis Sendiri)</option>
                            </select>
                            <input type="text" id="platform-custom" placeholder="Masukkan nama platform lainnya..." 
                                   class="w-full border border-gray-300 rounded p-2 mt-2 {{ !in_array(old('platform', $course->platform), ['Coursera', 'Udemy', 'edX', 'Udacity', 'Codecademy', 'FutureLearn']) && old('platform', $course->platform) != '' ? '' : 'hidden' }}"
                                   value="{{ !in_array(old('platform', $course->platform), ['Coursera', 'Udemy', 'edX', 'Udacity', 'Codecademy', 'FutureLearn']) && old('platform', $course->platform) != '' ? old('platform', $course->platform) : '' }}"
                                   oninvalid="this.setCustomValidity('Please fill out this field')" 
                                   oninput="this.setCustomValidity('')">
                            @error('platform')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Link --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Link Course</label>
                            <input type="url" name="link" value="{{ old('link', $course->link) }}" 
                                   class="w-full border border-gray-300 rounded p-2 @error('link') border-red-500 @enderror" required
                                   placeholder="https://example.com/course"
                                   oninvalid="this.setCustomValidity('Please fill out this field')" 
                                   oninput="this.setCustomValidity('')">
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

<script>
function updateDurasi() {
    const angka = document.getElementById('durasi_angka').value;
    const satuan = document.getElementById('durasi_satuan').value;
    const hiddenInput = document.getElementById('durasi_hidden');
    
    if (angka && satuan) {
        hiddenInput.value = angka + ' ' + satuan;
    } else {
        hiddenInput.value = '';
    }
}

function handleBahasaChange(selectElement) {
    const customInput = document.getElementById('bahasa-custom');
    
    if (selectElement.value === 'other') {
        // Show custom input and transfer name attribute
        customInput.classList.remove('hidden');
        customInput.required = true;
        customInput.setAttribute('name', 'bahasa');
        selectElement.removeAttribute('name');
        selectElement.setCustomValidity('');
    } else {
        // Hide custom input and keep name on dropdown
        customInput.classList.add('hidden');
        customInput.required = false;
        customInput.value = '';
        customInput.removeAttribute('name');
        selectElement.setAttribute('name', 'bahasa');
        
        if (selectElement.value !== '') {
            selectElement.setCustomValidity('');
        } else {
            selectElement.setCustomValidity('Please select an option');
        }
    }
}

function handleTipeChange(selectElement) {
    const customInput = document.getElementById('tipe-custom');
    
    if (selectElement.value === 'other') {
        // Show custom input and transfer name attribute
        customInput.classList.remove('hidden');
        customInput.required = true;
        customInput.setAttribute('name', 'tipe');
        selectElement.removeAttribute('name');
        selectElement.setCustomValidity('');
    } else {
        // Hide custom input and keep name on dropdown
        customInput.classList.add('hidden');
        customInput.required = false;
        customInput.value = '';
        customInput.removeAttribute('name');
        selectElement.setAttribute('name', 'tipe');
        
        if (selectElement.value !== '') {
            selectElement.setCustomValidity('');
        } else {
            selectElement.setCustomValidity('Please select an option');
        }
    }
}

function handlePlatformChange(selectElement) {
    const customInput = document.getElementById('platform-custom');
    
    if (selectElement.value === 'other') {
        // Show custom input and transfer name attribute
        customInput.classList.remove('hidden');
        customInput.required = true;
        customInput.setAttribute('name', 'platform');
        selectElement.removeAttribute('name');
        selectElement.setCustomValidity('');
    } else {
        // Hide custom input and keep name on dropdown
        customInput.classList.add('hidden');
        customInput.required = false;
        customInput.value = '';
        customInput.removeAttribute('name');
        selectElement.setAttribute('name', 'platform');
        
        if (selectElement.value !== '') {
            selectElement.setCustomValidity('');
        } else {
            selectElement.setCustomValidity('Please select an option');
        }
    }
}

// Initialize the form properly
document.addEventListener('DOMContentLoaded', function() {
    // Check if custom inputs should be shown on load
    const bahasaValue = "{{ old('bahasa', $course->bahasa) }}";
    const tipeValue = "{{ old('tipe', $course->tipe) }}";
    const platformValue = "{{ old('platform', $course->platform) }}";
    
    // Handle Bahasa initialization
    const bahasaPredefined = ['Indonesia', 'English', 'Mandarin', 'Spanish', 'French', 'German', 'Japanese', 'Korean', 'Arabic', 'Portuguese', 'Russian', 'Italian'];
    if (bahasaValue && !bahasaPredefined.includes(bahasaValue)) {
        document.getElementById('bahasa-dropdown').removeAttribute('name');
        document.getElementById('bahasa-custom').setAttribute('name', 'bahasa');
        document.getElementById('bahasa-custom').required = true;
    } else {
        document.getElementById('bahasa-dropdown').setAttribute('name', 'bahasa');
        document.getElementById('bahasa-custom').removeAttribute('name');
        document.getElementById('bahasa-custom').required = false;
    }
    
    // Handle Tipe initialization
    const tipePredefined = ['Course', 'Specialization', 'Professional Certificate', 'Guided Project', 'Tutorial', 'Workshop'];
    if (tipeValue && !tipePredefined.includes(tipeValue)) {
        document.getElementById('tipe-dropdown').removeAttribute('name');
        document.getElementById('tipe-custom').setAttribute('name', 'tipe');
        document.getElementById('tipe-custom').required = true;
    } else {
        document.getElementById('tipe-dropdown').setAttribute('name', 'tipe');
        document.getElementById('tipe-custom').removeAttribute('name');
        document.getElementById('tipe-custom').required = false;
    }
    
    // Handle Platform initialization
    const platformPredefined = ['Coursera', 'Udemy', 'edX', 'Udacity', 'Codecademy', 'FutureLearn'];
    if (platformValue && !platformPredefined.includes(platformValue)) {
        document.getElementById('platform-dropdown').removeAttribute('name');
        document.getElementById('platform-custom').setAttribute('name', 'platform');
        document.getElementById('platform-custom').required = true;
    } else {
        document.getElementById('platform-dropdown').setAttribute('name', 'platform');
        document.getElementById('platform-custom').removeAttribute('name');
        document.getElementById('platform-custom').required = false;
    }
    
    // Initialize durasi hidden field
    updateDurasi();
});
</script>
@endsection