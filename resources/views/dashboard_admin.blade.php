<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        .notification {
            display: none;
            animation: slideDown 0.3s ease-out;
        }
        .notification.show {
            display: block;
        }
        @keyframes slideDown {
            from { transform: translateY(-100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Header Admin -->
    @include('layouts.header_admin')
    
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @include('layouts.sidebar_admin')
        
        <!-- Notification -->
        <div id="notification" class="notification fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            <span id="notificationText">Berhasil memperbarui profil!</span>
        </div>

        <!-- Main Content -->
        <main class="flex-1 ml-64 py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    
                    <!-- Dashboard Section (Default) -->
                    <div id="dashboard-section" class="content-section">
                        <!-- Welcome Section -->
                        <div class="p-6 lg:p-8 bg-gradient-to-r from-indigo-50 to-purple-50 border-b border-gray-200">
                            <div class="w-12 h-12 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center mb-8 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                                </svg>
                            </div>

                            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                                Selamat Datang di Admin Dashboard! 👋
                            </h1>

                            <p class="mt-4 text-gray-600 leading-relaxed text-lg">
                                Kelola Sistem Rekomendasi Online Course dengan mudah dan efisien
                            </p>
                        </div>

                        <!-- Quick Stats -->
                        <div class="p-6 lg:p-8 bg-gray-50 border-b border-gray-200">
                            <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                <svg class="w-6 h-6 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                Statistik Sistem
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="text-3xl font-bold text-indigo-600">{{ $totalUsers }}</div>
                                            <div class="text-sm text-gray-600 mt-1">Total Pengguna</div>
                                        </div>
                                        <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="text-3xl font-bold text-green-600">{{ $totalCourses }}</div>
                                            <div class="text-sm text-gray-600 mt-1">Total Course</div>
                                        </div>
                                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="text-3xl font-bold text-yellow-600">{{ $totalKriteria }}</div>
                                            <div class="text-sm text-gray-600 mt-1"> Total Kriteria</div>
                                        </div>
                                        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="text-3xl font-bold text-red-600">3</div>
                                            <div class="text-sm text-gray-600 mt-1">Masalah Sistem</div>
                                        </div>
                                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.888-.833-2.664 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>

                        <!-- Features Grid -->
                        <div class="bg-gradient-to-br from-gray-50 to-indigo-50 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                            
                            <!-- Manage Courses -->
                            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 hover:transform hover:scale-105">
                                <div class="flex items-center mb-4">
                                    <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" class="w-6 h-6 stroke-indigo-600">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                        </svg>
                                    </div>
                                    <h2 class="text-xl font-bold text-gray-900">
                                        Kelola Kursus
                                    </h2>
                                </div>

                                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                    Tambah, edit, atau hapus kursus online dalam sistem. Kelola semua aspek kursus 
                                    termasuk materi, instruktur, dan pengaturan akses.
                                </p>

                                <div class="mt-6">
                                <a href="{{ route('course.index') }}" class="inline-flex items-center font-semibold text-blue-700 hover:text-blue-900 transition-colors duration-200">
                                        Kelola Kursus
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 w-5 h-5 fill-blue-500">
                                            <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <!-- System Analytics -->
                            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 hover:transform hover:scale-105">
                                <div class="flex items-center mb-4">
                                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" class="w-6 h-6 stroke-purple-600">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                                        </svg>
                                    </div>
                                    <h2 class="text-xl font-bold text-gray-900">
                                         Kriteria
                                    </h2>
                                </div>

                                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                    Lihat kriteria yang digunakan untuk mencari rekomendasi menggunakan metode profile matching dengan interpolasi linear
                                </p>
                                <div class="mt-6">
                                <a href="{{ route('kriteria.index') }}" class="inline-flex items-center font-semibold text-blue-700 hover:text-blue-900 transition-colors duration-200">
                                        Lihat Kriteria
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 w-5 h-5 fill-blue-500">
                                            <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Other Sections -->
                    <div id="courses-section" class="content-section hidden">
                        <div class="p-6 lg:p-8">
                            <h2 class="text-2xl font-medium text-gray-900 mb-6">Kelola Kursus</h2>
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <p class="text-gray-600">Fitur kelola kursus akan ditampilkan di sini.</p>
                            </div>
                        </div>
                    </div>

                    <div id="users-section" class="content-section hidden">
                        <div class="p-6 lg:p-8">
                            <h2 class="text-2xl font-medium text-gray-900 mb-6">Manajemen Pengguna</h2>
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <p class="text-gray-600">Fitur manajemen pengguna akan ditampilkan di sini.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

    <script>
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.add('hidden');
            });
            
            // Show selected section
            document.getElementById(sectionId + '-section').classList.remove('hidden');
        }
    </script>
</body>
</html>