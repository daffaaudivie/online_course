<!-- Sidebar -->
<div class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-800 shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0" id="sidebar">
    <!-- Sidebar Header -->
    <div class="flex items-center justify-center h-16 bg-gray-900 border-b border-gray-700">
        <h1 class="text-xl font-bold text-white">Admin Panel</h1>
    </div>

    <!-- Navigation Menu -->
    <nav class="mt-8">
        <div class="px-4 space-y-2">
            <!-- Dashboard Menu -->
            <a href="{{ route('dashboard_admin') }}"
               class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 text-white' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                </svg>
                <span class="font-medium">Dashboard</span>
            </a>

            <!-- Data Course Menu -->
             <a href="{{ route('course.index') }}"
               class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200 {{ request()->routeIs('admin.courses.*') ? 'bg-gray-700 text-white' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z"></path>
                </svg>
                <span class="font-medium">Data Course</span>
            </a>

            <!-- Data Kriteria Menu -->
            <a href="{{ route('kriteria.index') }}"
               class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200 {{ request()->routeIs('admin.kriteria.*') ? 'bg-gray-700 text-white' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h2m0 0h2m-2 0v4a2 2 0 002 2h2a2 2 0 002-2v-4m-6 0V9a2 2 0 012-2h2a2 2 0 012 2v6"></path>
                </svg>
                <span class="font-medium">Data Kriteria</span>
            </a>

            <!-- Data User Menu -->
            <!-- <a href="#"
               class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition-colors duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-gray-700 text-white' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"></path>
                </svg>
                <span class="font-medium">Data User</span>
            </a> -->
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.0512 8.94293L19.6073 11.499C20.1195 12.0113 20.1195 12.8297 19.6073 13.342L17.0512 15.8981M3.5 12.4205L19.2488 12.4205M12.2488 21.4205C12.2488 21.4205 9.20878 21.4205 7.24878 21.4205C5.04878 21.4205 3.24878 19.6205 3.24878 17.4205L3.24878 7.42053C3.24878 5.22053 5.04878 3.42053 7.24878 3.42053L12.2488 3.42053"></path>
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
