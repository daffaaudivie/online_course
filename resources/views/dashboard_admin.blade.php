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
                            <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                                <div class="w-12 h-12 bg-indigo-600 rounded-lg flex items-center justify-center mb-8">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                                    </svg>
                                </div>

                                <h1 class="text-2xl font-medium text-gray-900">
                                    Selamat Datang, Admin!
                                </h1>

                                <p class="mt-6 text-gray-500 leading-relaxed">
                                    Selamat datang di dashboard untuk Sistem Rekomendasi Online Course 
                                </p>
                            </div>

                            <!-- Quick Stats -->
                            <div class="p-6 lg:p-8 bg-gray-50 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900 mb-4">Statistik Cepat</h2>
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <div class="bg-white p-4 rounded-lg shadow">
                                        <div class="text-2xl font-bold text-indigo-600">1,234</div>
                                        <div class="text-sm text-gray-600">Total Pengguna</div>
                                    </div>
                                    <div class="bg-white p-4 rounded-lg shadow">
                                        <div class="text-2xl font-bold text-green-600">56</div>
                                        <div class="text-sm text-gray-600">Total Kursus</div>
                                    </div>
                                    <div class="bg-white p-4 rounded-lg shadow">
                                        <div class="text-2xl font-bold text-yellow-600">789</div>
                                        <div class="text-sm text-gray-600">Pendaftaran Aktif</div>
                                    </div>
                                    <div class="bg-white p-4 rounded-lg shadow">
                                        <div class="text-2xl font-bold text-red-600">3</div>
                                        <div class="text-sm text-gray-600">Masalah Sistem</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Features Grid -->
                            <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                                
                                <!-- Manage Courses -->
                                <div class="bg-white p-6 rounded-lg shadow">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-indigo-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                        </svg>
                                        <h2 class="ms-3 text-xl font-semibold text-gray-900">
                                            Kelola Kursus
                                        </h2>
                                    </div>

                                    <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                                        Tambah, edit, atau hapus kursus online dalam sistem. Kelola semua aspek kursus 
                                        termasuk materi, instruktur, dan pengaturan akses dengan interface yang mudah digunakan.
                                    </p>

                                    <div class="mt-4">
                                        <button onclick="showSection('courses')" class="inline-flex items-center font-semibold text-indigo-700 hover:text-indigo-900">
                                            Kelola Kursus
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 w-5 h-5 fill-indigo-500">
                                                <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- User Management -->
                                <div class="bg-white p-6 rounded-lg shadow">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-indigo-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                        </svg>
                                        <h2 class="ms-3 text-xl font-semibold text-gray-900">
                                            Manajemen Pengguna
                                        </h2>
                                    </div>

                                    <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                                        Lihat dan kelola pengguna terdaftar dan administrator. Atur hak akses, status akun, 
                                        dan monitor aktivitas pengguna untuk memastikan keamanan sistem.
                                    </p>

                                    <div class="mt-4">
                                        <button onclick="showSection('users')" class="inline-flex items-center font-semibold text-indigo-700 hover:text-indigo-900">
                                            Kelola Pengguna
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 w-5 h-5 fill-indigo-500">
                                                <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Reports -->
                                <div class="bg-white p-6 rounded-lg shadow">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-indigo-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                                        </svg>
                                        <h2 class="ms-3 text-xl font-semibold text-gray-900">
                                            Laporan Sistem
                                        </h2>
                                    </div>

                                    <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                                        Lihat analitik, log sistem, dan laporan untuk wawasan yang lebih baik. 
                                        Dapatkan insight yang berguna untuk pengambilan keputusan administratif.
                                    </p>

                                    <div class="mt-4">
                                        <button onclick="showSection('reports')" class="inline-flex items-center font-semibold text-indigo-700 hover:text-indigo-900">
                                            Lihat Laporan
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 w-5 h-5 fill-indigo-500">
                                                <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Settings -->
                                <div class="bg-white p-6 rounded-lg shadow">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-6 h-6 stroke-indigo-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <h2 class="ms-3 text-xl font-semibold text-gray-900">
                                            Pengaturan Sistem
                                        </h2>
                                    </div>

                                    <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                                        Konfigurasi aplikasi sesuai kebutuhan Anda. Atur preferensi sistem, 
                                        konfigurasi keamanan, dan berbagai pengaturan administratif lainnya.
                                    </p>

                                    <div class="mt-4">
                                        <button onclick="showSection('settings')" class="inline-flex items-center font-semibold text-indigo-700 hover:text-indigo-900">
                                            Buka Pengaturan
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ms-1 w-5 h-5 fill-indigo-500">
                                                <path fill-rule="evenodd" d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Profile Section -->
                        <div id="profile-section" class="content-section hidden">
                            <div class="p-6 lg:p-8">
                                <h2 class="text-2xl font-medium text-gray-900 mb-6">Profile Administrator</h2>
                                <div class="bg-gray-50 p-6 rounded-lg">
                                    <div class="flex items-center space-x-4 mb-4">
                                        <img class="h-16 w-16 rounded-full" src="https://ui-avatars.com/api/?name=Admin&background=6366f1&color=fff&size=64" alt="Profile">
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-900">Administrator</h3>
                                            <p class="text-gray-500">admin@example.com</p>
                                            <p class="text-sm text-gray-400">Bergabung sejak: 1 Januari 2024</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                            <p class="mt-1 text-sm text-gray-900">Administrator</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Email</label>
                                            <p class="mt-1 text-sm text-gray-900">admin@example.com</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Role</label>
                                            <p class="mt-1 text-sm text-gray-900">Super Administrator</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Status</label>
                                            <span class="mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                        </div>
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

                        <div id="reports-section" class="content-section hidden">
                            <div class="p-6 lg:p-8">
                                <h2 class="text-2xl font-medium text-gray-900 mb-6">Laporan Sistem</h2>
                                <div class="bg-gray-50 p-6 rounded-lg">
                                    <p class="text-gray-600">Fitur laporan sistem akan ditampilkan di sini.</p>
                                </div>
                            </div>
                        </div>

                        <div id="settings-section" class="content-section hidden">
                            <div class="p-6 lg:p-8">
                                <h2 class="text-2xl font-medium text-gray-900 mb-6">Pengaturan Sistem</h2>
                                <div class="bg-gray-50 p-6 rounded-lg">
                                    <p class="text-gray-600">Fitur pengaturan sistem akan ditampilkan di sini.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </main>
        </div>

        <script>
            function showSection(sectionName) {
                // Hide all sections
                const sections = document.querySelectorAll('.content-section');
                sections.forEach(section => {
                    section.classList.add('hidden');
                });
                
                // Show selected section
                const targetSection = document.getElementById(sectionName + '-section');
                if (targetSection) {
                    targetSection.classList.remove('hidden');
                }
            }

            function showNotification(message) {
                const notification = document.getElementById('notification');
                const notificationText = document.getElementById('notificationText');
                
                notificationText.textContent = message;
                notification.classList.add('show');
                
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 3000);
            }
        </script>
    </body>
    </html>