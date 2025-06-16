@extends('layouts.user')

@section('content')
<main class="flex-1 py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

            <!-- Welcome Section -->
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mb-8">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                    </svg>
                </div>

                <h1 class="text-2xl font-medium text-gray-900">
                    Selamat Datang di Dashboard Anda!
                </h1>

                <p class="mt-6 text-gray-500 leading-relaxed">
                    Selamat Datang di Sistem Rekomendasi Online Course Menggunakan Metode Profile Matching Dengan Interpolasi Linear
                </p>
            </div>

            <!-- Quick Stats -->
            <div class="p-6 lg:p-8 bg-gray-50 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Statistik Pembelajaran Anda</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="bg-white p-4 rounded-lg shadow">
                        <div class="text-2xl font-bold text-blue-600">5</div>
                        <div class="text-sm text-gray-600">Kursus Diikuti</div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow">
                        <div class="text-2xl font-bold text-green-600">3</div>
                        <div class="text-sm text-gray-600">Kursus Selesai</div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow">
                        <div class="text-2xl font-bold text-yellow-600">75%</div>
                        <div class="text-sm text-gray-600">Progress Rata-rata</div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow">
                        <div class="text-2xl font-bold text-purple-600">12</div>
                        <div class="text-sm text-gray-600">Jam Belajar</div>
                    </div>
                </div>
            </div>

            <!-- Features Grid -->
            <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                <!-- Jelajahi Kursus -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                        <h2 class="ms-3 text-xl font-semibold text-gray-900">
                            Jelajahi Kursus
                        </h2>
                    </div>

                    <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                        Temukan kursus-kursus menarik yang sesuai dengan minat dan kebutuhan Anda.
                    </p>

                    <div class="mt-4">
                        <a href="{{ route('user.courses') }}" class="inline-flex items-center font-semibold text-blue-700 hover:text-blue-900">
                            Lihat Semua Kursus
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 w-5 h-5 fill-blue-500">
                                <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Pembelajaran Saya -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                        <h2 class="ms-3 text-xl font-semibold text-gray-900">
                            Pembelajaran Saya
                        </h2>
                    </div>

                    <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                        Pantau progress pembelajaran Anda, lanjutkan kursus yang sedang berjalan.
                    </p>

                    <div class="mt-4">
                        <button class="inline-flex items-center font-semibold text-blue-700 hover:text-blue-900">
                            Lihat Progress
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 w-5 h-5 fill-blue-500">
                                <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Sertifikat Saya -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M15.75 4.5c0-1.38-1.12-2.5-2.5-2.5h-3.5c-1.38 0-2.5 1.12-2.5 2.5v1.372c0 .516.235 1.004.639 1.323l3.361 2.652c.26.205.639.205.9 0l3.361-2.652c.404-.319.639-.807.639-1.323V4.5z" />
                        </svg>
                        <h2 class="ms-3 text-xl font-semibold text-gray-900">
                            Sertifikat Saya
                        </h2>
                    </div>
                    <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                        Kumpulkan sertifikat dari kursus yang telah Anda selesaikan.
                    </p>
                </div>

                <!-- Pengaturan Profil -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <h2 class="ms-3 text-xl font-semibold text-gray-900">
                            Pengaturan Profil
                        </h2>
                    </div>
                    <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                        Kelola informasi pribadi Anda dan atur preferensi belajar.
                    </p>
                </div>
            </div>

            <!-- Aktivitas Terbaru -->
            <div class="p-6 lg:p-8 bg-white border-t border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Aktivitas Terbaru</h2>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                        <div class="w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                        <div>
                            <p class="text-sm text-gray-900">Menyelesaikan modul "Introduction to Web Development"</p>
                            <p class="text-xs text-gray-500">2 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                        <div>
                            <p class="text-sm text-gray-900">Mendaftar kursus "Advanced JavaScript Concepts"</p>
                            <p class="text-xs text-gray-500">1 hari yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                        <div class="w-2 h-2 bg-yellow-500 rounded-full mt-2"></div>
                        <div>
                            <p class="text-sm text-gray-900">Mendapatkan sertifikat "HTML & CSS Fundamentals"</p>
                            <p class="text-xs text-gray-500">3 hari yang lalu</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection
