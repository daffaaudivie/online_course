<!-- Sidebar -->
<div class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-800 shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0" id="sidebar">
    <!-- Sidebar Header -->
    <div class="flex items-center justify-center h-16 bg-gray-900 border-b border-gray-700">
        <h1 class="text-xl font-bold text-white">User Panel</h1>
    </div>

    <!-- Navigation Menu -->
    <nav class="mt-8">
        <div class="px-4 space-y-2">
            <!-- Dashboard Menu -->
            <a href="{{ route('dashboard') }}"
               class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 text-white' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
                <span class="font-medium">Dashboard</span>
            </a>

            <!-- Data Course Menu -->
             <a href="{{ route('user.courses') }}"
               class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200 {{ request()->routeIs('admin.courses.*') ? 'bg-gray-700 text-white' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                </svg>
                <span class="font-medium">Data Course</span>
            </a>

            <!-- Data Kriteria Menu -->
            <!-- <a href="{{ route('kriteria.indexUser') }}"
               class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200 {{ request()->routeIs('admin.kriteria.*') ? 'bg-gray-700 text-white' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h6a2 2 0 002-2V7a2 2 0 00-2-2H9z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 9h6m-6 4h6m2 5H7a2 2 0 01-2-2V7a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span class="font-medium">Data Kriteria</span>
            </a> -->

            <!-- Rekomendasi Course Menu -->
            <a href="{{ route('rekomendasi.form') }}"
               class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200 {{ request()->routeIs('admin.kriteria.*') ? 'bg-gray-700 text-white' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
                <span class="font-medium">Rekomendasi Course</span>
            </a>

            <!-- Riwayat Rekomendasi Menu -->
            <a href="{{ route('rekomendasi.riwayat') }}"
               class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200 {{ request()->routeIs('admin.kriteria.*') ? 'bg-gray-700 text-white' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">Riwayat Rekomendasi</span>
            </a>

            <!-- Data User Favorite -->
            <a href="{{ route('favorites.index') }}"
               class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-gray-700 text-white' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                <span class="font-medium">Course Favorit</span>
            </a>
        </div>

        <!-- Divider -->
        <div class="mt-8 pt-4 border-t border-gray-700">
            <div class="px-4 space-y-2">
                <!-- Logout Menu -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="flex items-center w-full px-4 py-3 text-gray-300 rounded-lg hover:bg-red-600 hover:text-white transition-colors duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span class="font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
</div>

<!-- Mobile Sidebar Overlay -->
<div class="fixed inset-0 z-40 bg-gray-600 bg-opacity-50 lg:hidden hidden" id="sidebar-overlay" onclick="toggleSidebar()"></div>

<!-- Mobile Menu Button Script -->
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }

    document.addEventListener('click', function(event) {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const menuButton = document.getElementById('mobile-menu-button');

        if (!sidebar.contains(event.target) && !menuButton?.contains(event.target) && !overlay.classList.contains('hidden')) {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }
    });
</script>