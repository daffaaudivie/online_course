@extends('layouts.admin')

@section('content')
<main class="flex-1 ml-64 py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Data Online Course</h2>

            {{-- Tab Navigation --}}
            <div class="mb-6">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8">
                        <button onclick="showTab('manual')" id="manual-tab" 
                                class="tab-button py-2 px-1 border-b-2 border-blue-500 font-medium text-sm text-blue-600">
                            Input Manual
                        </button>
                        <button onclick="showTab('excel')" id="excel-tab"
                                class="tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                            Upload Excel
                        </button>
                    </nav>
                </div>
            </div>

            {{-- Manual Input Tab --}}
            <div id="manual-content" class="tab-content">
                <form action="{{ route('course.store') }}" method="POST">
                    @csrf

                    {{-- Judul --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Judul</label>
                        <input type="text" name="judul" class="w-full border border-gray-300 rounded p-2" required 
                               oninvalid="this.setCustomValidity('Please fill out this field')" 
                               oninput="this.setCustomValidity('')">
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-1">Deskripsi</label>
                        <textarea name="deskripsi" rows="4" class="w-full border border-gray-300 rounded p-2" required
                                  oninvalid="this.setCustomValidity('Please fill out this field')" 
                                  oninput="this.setCustomValidity('')"></textarea>
                    </div>

                    {{-- Grid Input --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Kategori --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Kategori</label>
                            <input type="text" name="kategori" class="w-full border border-gray-300 rounded p-2" 
                                   placeholder="Contoh: Data Science" required
                                   oninvalid="this.setCustomValidity('Please fill out this field')" 
                                   oninput="this.setCustomValidity('')">
                        </div>

                        {{-- Harga --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Harga (Rp)</label>
                            <input type="number" name="harga" class="w-full border border-gray-300 rounded p-2" 
                                   placeholder="500000" min="0" required
                                   oninvalid="this.setCustomValidity('Please fill out this field')" 
                                   oninput="this.setCustomValidity(''); formatHarga(this)">
                            <small class="text-gray-500">Masukkan angka saja (tanpa titik atau koma)</small>
                        </div>

                        {{-- Rating --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Rating</label>
                            <input type="number" step="0.1" max="5" min="0" name="rating" class="w-full border border-gray-300 rounded p-2" 
                                   placeholder="Contoh: 1.0-5.0" required
                                   oninvalid="this.setCustomValidity('Please fill out this field')" 
                                   oninput="this.setCustomValidity('')">
                                   <small class="text-gray-500">Tambahkan titik diantara nomor</small>
                        </div>

                        {{-- Jumlah Viewers --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Jumlah Viewers</label>
                            <input type="number" name="jumlah_viewers" class="w-full border border-gray-300 rounded p-2" 
                                   placeholder="5000" min="0" required
                                   oninvalid="this.setCustomValidity('Please fill out this field')" 
                                   oninput="this.setCustomValidity('')">
                                   <small class="text-gray-500">Masukkan angka saja (tanpa titik atau koma)</small>
                        </div>

                        {{-- Bahasa --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Bahasa</label>
                            <select id="bahasa-dropdown" name="bahasa" class="w-full border border-gray-300 rounded p-2" required
                                    oninvalid="this.setCustomValidity('Please select an option')" 
                                    onchange="handleBahasaChange(this)">
                                <option value="">Pilih Bahasa</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="English">English</option>
                                <option value="Mandarin">Mandarin</option>
                                <option value="Spanish">Spanish</option>
                                <option value="French">French</option>
                                <option value="German">German</option>
                                <option value="Japanese">Japanese</option>
                                <option value="Korean">Korean</option>
                                <option value="Arabic">Arabic</option>
                                <option value="Portuguese">Portuguese</option>
                                <option value="Russian">Russian</option>
                                <option value="Italian">Italian</option>
                                <option value="other">Lainnya (Tulis Sendiri)</option>
                            </select>
                            <input type="text" id="bahasa-custom" placeholder="Masukkan bahasa lainnya..." 
                                   class="w-full border border-gray-300 rounded p-2 mt-2 hidden"
                                   oninvalid="this.setCustomValidity('Please fill out this field')" 
                                   oninput="this.setCustomValidity('')">
                        </div>

                        {{-- Tipe Course --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Tipe Course</label>
                            <select id="tipe-dropdown" name="tipe" class="w-full border border-gray-300 rounded p-2" required
                                    oninvalid="this.setCustomValidity('Please select an option')" 
                                    onchange="handleTipeChange(this)">
                                <option value="">Pilih Tipe Course</option>
                                <option value="Course">Course</option>
                                <option value="Specialization">Specialization</option>
                                <option value="Professional Certificate">Professional Certificate</option>
                                <option value="Guided Project">Guided Project</option>
                                <option value="Tutorial">Tutorial</option>
                                <option value="Workshop">Workshop</option>
                                <option value="other">Lainnya (Tulis Sendiri)</option>
                            </select>
                            <input type="text" id="tipe-custom" placeholder="Masukkan tipe course lainnya..." 
                                   class="w-full border border-gray-300 rounded p-2 mt-2 hidden"
                                   oninvalid="this.setCustomValidity('Please fill out this field')" 
                                   oninput="this.setCustomValidity('')">
                        </div>

                        {{-- Durasi --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Durasi</label>
                            <div class="flex gap-2">
                                <input type="number" id="durasi_angka" class="flex-1 border border-gray-300 rounded p-2" 
                                       placeholder="6" min="1" required
                                       oninvalid="this.setCustomValidity('Please fill out this field')" 
                                       oninput="this.setCustomValidity(''); updateDurasi()">
                                <select id="durasi_satuan" class="flex-1 border border-gray-300 rounded p-2" required
                                        onchange="updateDurasi()">
                                    <option value="">Pilih Satuan</option>
                                    <option value="days">Hari</option>
                                    <option value="weeks">Minggu</option>
                                    <option value="months">Bulan</option>
                                </select>
                            </div>
                            <input type="hidden" name="durasi" id="durasi_hidden">
                            <small class="text-gray-500">Contoh: 6 Bulan akan tersimpan sebagai "6 months"</small>
                        </div>

                        {{-- Level --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Tingkat Kesulitan</label>
                            <select name="level" class="w-full border border-gray-300 rounded p-2" required
                                    oninvalid="this.setCustomValidity('Please select an option')" 
                                    onchange="this.setCustomValidity('')">
                                <option value="">Pilih Tingkat Kesulitan</option>
                                <option value="Beginner">Beginner</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Advanced">Advanced</option>
                                <option value="Unknown">Unknown</option>
                            </select>
                        </div>

                        {{-- Platform --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Platform</label>
                            <select id="platform-dropdown" name="platform" class="w-full border border-gray-300 rounded p-2" required
                                    oninvalid="this.setCustomValidity('Please select an option')" 
                                    onchange="handlePlatformChange(this)">
                                <option value="">Pilih Platform</option>
                                <option value="Coursera">Coursera</option>
                                <option value="Udemy">Udemy</option>
                                <option value="edX">edX</option>
                                <option value="Udacity">Udacity</option>
                                <option value="Codecademy">Codecademy</option>
                                <option value="FutureLearn">FutureLearn</option>
                                <option value="other">Lainnya (Tulis Sendiri)</option>
                            </select>
                            <input type="text" id="platform-custom" placeholder="Masukkan nama platform lainnya..." 
                                   class="w-full border border-gray-300 rounded p-2 mt-2 hidden"
                                   oninvalid="this.setCustomValidity('Please fill out this field')" 
                                   oninput="this.setCustomValidity('')">
                        </div>

                        {{-- Link --}}
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Link Course</label>
                            <input type="url" name="link" class="w-full border border-gray-300 rounded p-2" required
                                   placeholder="https://example.com/course"
                                   oninvalid="this.setCustomValidity('Please fill out this field')" 
                                   oninput="this.setCustomValidity('')">
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
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>

            {{-- Excel Upload Tab --}}
            <div id="excel-content" class="tab-content hidden">
                <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <h3 class="text-lg font-semibold text-blue-800 mb-2">📊 Import Data dari Excel</h3>
                    <p class="text-blue-700 mb-3">Upload file Excel untuk menambahkan multiple data course sekaligus</p>
                    
                    {{-- Download Template --}}
                    <div class="mb-4">
                        <a href="{{ route('course.download-template') }}" 
                           class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download Template Excel
                        </a>
                        <p class="text-sm text-gray-600 mt-1">Gunakan template ini sebagai format untuk upload data</p>
                    </div>
                </div>

                <form action="{{ route('course.import') }}" method="POST" enctype="multipart/form-data">
                 @csrf

                    {{-- Upload Area --}}
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Upload File Excel</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="excel-file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500">
                                        <span class="font-semibold">Klik untuk upload</span> atau drag and drop
                                    </p>
                                    <p class="text-xs text-gray-500">Hanya file .xlsx atau .xls</p>
                                </div>
                                <input id="excel-file" name="excel_file" type="file" class="hidden" accept=".xlsx,.xls" required 
                                       oninvalid="this.setCustomValidity('Please fill out this field')" 
                                       oninput="this.setCustomValidity('')" onchange="showFileName(this)">
                            </label>
                        </div>
                        <div id="file-name" class="mt-2 text-sm text-gray-600 hidden"></div>
                    </div>

                    {{-- Instructions --}}
                    <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <h4 class="font-semibold text-yellow-800 mb-2">⚠️ Petunjuk Import:</h4>
                        <ul class="text-sm text-yellow-700 space-y-1">
                            <li>• Pastikan format file sesuai dengan template yang disediakan</li>
                            <li>• Semua kolom harus diisi</li>
                            <li>• Harga dan Jumlah Viewers harus berupa angka</li>
                            <li>• Link Course harus berupa URL yang valid</li>
                            <li>• Tipe Course harus salah satu dari: Course, Specialization, Professional Certificate, dll.</li>
                            <li>• Level harus salah satu dari: Beginner, Intermediate, Advanced, Expert</li>
                            <li>• Platform harus salah satu dari platform yang tersedia</li>
                            <li>• Bahasa harus salah satu dari bahasa yang tersedia</li>
                            <li>• Durasi harus dalam format: "angka satuan" (contoh: "6 months", "2 weeks")</li>
                        </ul>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end mt-8">
                        <a href="{{ route('course.index') }}"
                           class="px-4 py-2 bg-gray-300 text-gray-800 rounded mr-2 hover:bg-gray-400">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-6 py-2 bg-green-600 text-white font-semibold rounded hover:bg-green-700">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 12l2 2 4-4"></path>
                            </svg>
                            Import Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
function showTab(tabName) {
    // Hide all tab contents
    const tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(content => content.classList.add('hidden'));
    
    // Remove active class from all tabs
    const tabButtons = document.querySelectorAll('.tab-button');
    tabButtons.forEach(button => {
        button.classList.remove('border-blue-500', 'text-blue-600');
        button.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected tab content
    document.getElementById(tabName + '-content').classList.remove('hidden');
    
    // Add active class to selected tab
    const activeTab = document.getElementById(tabName + '-tab');
    activeTab.classList.remove('border-transparent', 'text-gray-500');
    activeTab.classList.add('border-blue-500', 'text-blue-600');
}

function showFileName(input) {
    const fileNameDiv = document.getElementById('file-name');
    if (input.files && input.files[0]) {
        fileNameDiv.textContent = '📁 File terpilih: ' + input.files[0].name;
        fileNameDiv.classList.remove('hidden');
    }
}

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
    // Ensure all dropdowns have name attributes by default
    document.getElementById('bahasa-dropdown').setAttribute('name', 'bahasa');
    document.getElementById('tipe-dropdown').setAttribute('name', 'tipe');
    document.getElementById('platform-dropdown').setAttribute('name', 'platform');
    
    // Ensure custom inputs don't have name attributes initially
    document.getElementById('bahasa-custom').removeAttribute('name');
    document.getElementById('tipe-custom').removeAttribute('name');
    document.getElementById('platform-custom').removeAttribute('name');
});
</script>
@endsection