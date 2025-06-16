<!-- Header untuk User -->
<header class="bg-white shadow relative z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-6">
            <!-- Tulisan Selamat Datang -->
            <div class="flex-1 text-left">
                <h1 class="text-xl font-semibold text-gray-800">
                    Selamat datang, {{ Auth::user()->name ?? 'User' }}
                </h1>
            </div>

            <!-- Dropdown Profil -->
            <div class="relative" x-data="{ profileOpen: false }">
                <button @click="profileOpen = !profileOpen" class="flex items-center space-x-3 text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=6366f1&color=fff" alt="Profile">
                    <span class="text-gray-700 font-medium">{{ Auth::user()->name ?? 'User' }}</span>
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Dropdown -->
                <div x-show="profileOpen"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    @click.away="profileOpen = false"
                    class="absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">

                    <div class="px-4 py-3 border-b border-gray-200">
                        <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name ?? 'User' }}</p>
                        <p class="text-sm text-gray-500">{{ Auth::user()->email ?? '-' }}</p>
                    </div>

                    <div class="py-1">
                        <a href="{{ route('profile.show') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profil Saya
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 text-left">
                                <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
