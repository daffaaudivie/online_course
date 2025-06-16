@extends('layouts.admin')

@section('content')
<main class="flex-1 ml-64 py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Online Course</h2>

            <div class="overflow-x-auto shadow-lg rounded-lg">
                <div class="flex justify-end mb-4">
                    <a href="{{ route('course.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Data
                    </a>
                </div>
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
                        @foreach ($courses as $index => $course)
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
                                <div class="flex items-center justify-center space-x-2">
                                    <!-- Tombol Detail -->
                                    <button onclick="openModal({{ $index }})" 
                                            class="inline-flex items-center px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Detail
                                    </button>
                                    
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('course.edit', $course) }}"
                                       class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </a>
                                    
                                    <!-- Tombol Delete -->
                                    <button onclick="confirmDelete({{ $course->id_online_course }}, '{{ addslashes($course->judul) }}')"
                                            class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination jika ada -->
            @if(method_exists($courses, 'links'))
            <div class="mt-6">
                {{ $courses->links() }}
            </div>
            @endif
        </div>
    </div>
</main>

<!-- Modal Detail Course -->
<div id="courseModal" class="fixed inset-0 bg-slate-900 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-10 mx-auto p-5 border border-slate-200 w-11/12 md:w-4/5 lg:w-3/4 xl:w-2/3 shadow-2xl rounded-lg bg-white max-h-[90vh] overflow-y-auto">
        <div class="mt-3">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 border-b border-slate-200 bg-slate-50 rounded-t-lg sticky top-0 z-10">
                <h3 class="text-xl font-semibold text-slate-800" id="modalTitle">
                    Detail Course
                </h3>
                <button onclick="closeModal()" class="text-slate-400 bg-transparent hover:bg-slate-200 hover:text-slate-600 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center transition-colors duration-200">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Modal Body -->
            <div class="p-6 space-y-6" id="modalBody">
                <div class="animate-pulse">
                    <div class="h-4 bg-slate-200 rounded w-3/4 mb-4"></div>
                    <div class="h-4 bg-slate-200 rounded w-full mb-2"></div>
                    <div class="h-4 bg-slate-200 rounded w-5/6"></div>
                </div>
            </div>
            
            <!-- Modal Footer -->
            <div class="flex items-center justify-end p-4 border-t border-slate-200 bg-slate-50 rounded-b-lg sticky bottom-0 z-10">
                <button onclick="closeModal()" class="px-4 py-2 bg-slate-500 hover:bg-slate-600 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Delete -->
<div id="deleteModal" class="fixed inset-0 bg-slate-900 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden">
    <div class="relative top-20 mx-auto p-5 border border-red-200 w-11/12 md:w-1/2 lg:w-1/3 shadow-2xl rounded-lg bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-center p-4 border-b border-red-200 bg-red-50 rounded-t-lg">
                <svg class="w-8 h-8 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
                <h3 class="text-xl font-semibold text-red-800">Konfirmasi Hapus</h3>
            </div>
            <div class="p-6 text-center">
                <p class="text-lg text-slate-700 mb-2">Apakah Anda yakin ingin menghapus course ini?</p>
                <p class="text-sm text-slate-500 mb-4" id="courseToDelete">Course yang akan dihapus akan ditampilkan di sini</p>
            </div>
            <div class="flex items-center justify-center space-x-4 p-4 border-t border-red-200 bg-red-50 rounded-b-lg">
                <button onclick="closeDeleteModal()" class="px-6 py-2 bg-slate-500 hover:bg-slate-600 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    Batal
                </button>
                <form id="deleteForm" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Data courses untuk modal - convert ke array biasa
const coursesData = {!! json_encode($courses->toArray()) !!};

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

function confirmDelete(courseId, courseTitle) {
    const deleteModal = document.getElementById('deleteModal');
    const courseToDelete = document.getElementById('courseToDelete');
    const deleteForm = document.getElementById('deleteForm');

    courseToDelete.innerHTML = `<strong>"${courseTitle}"</strong>`;
    deleteForm.action = `/admin/online_course/${courseId}`;

    deleteModal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}


function closeDeleteModal() {
    const deleteModal = document.getElementById('deleteModal');
    deleteModal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
document.getElementById('courseModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const courseModal = document.getElementById('courseModal');
        const deleteModal = document.getElementById('deleteModal');
        
        if (!courseModal.classList.contains('hidden')) {
            closeModal();
        }
        if (!deleteModal.classList.contains('hidden')) {
            closeDeleteModal();
        }
    }
});
</script>
@endsection