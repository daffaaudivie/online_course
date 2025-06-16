    <!-- Header dengan Profile Menu -->
    <header class="bg-white shadow relative z-40 pl-64">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    
                </div>

                <!-- Profile Dropdown -->
                <div class="relative" x-data="{ profileOpen: false }">
                    <button @click="profileOpen = !profileOpen" class="flex items-center space-x-3 text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=Admin&background=6366f1&color=fff" alt="Profile">
                        <span class="text-gray-700 font-medium">Administrator</span>
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="profileOpen" 
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95" 
                        @click.away="profileOpen = false"
                        class="absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
                        
                        <!-- Profile Header -->
                        <div class="px-4 py-3 border-b border-gray-200">
                            <p class="text-sm font-medium text-gray-900">Administrator</p>
                            <p class="text-sm text-gray-500">admin@example.com</p>
                        </div>

                        <!-- Profile Actions -->
                        <div class="py-1">
                            <!-- View Profile -->
                            <a href="#" onclick="showSection('profile')" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                View Profile
                            </a>

                            <!-- Update Profile Information -->
                            <a href="#" onclick="openModal('updateProfileModal')" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Update Profile
                            </a>

                            <!-- Update Password -->
                            <a href="#" onclick="openModal('updatePasswordModal')" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Change Password
                            </a>

                            <!-- Two Factor Authentication -->
                            <a href="#" onclick="openModal('twoFactorModal')" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                Two-Factor Auth
                            </a>

                            <div class="border-t border-gray-200 my-1"></div>

                            <!-- Logout Other Sessions -->
                            <a href="#" onclick="openModal('logoutSessionsModal')" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Logout Other Sessions
                            </a>

                            <!-- Delete Account -->
                            <a href="#" onclick="openModal('deleteAccountModal')" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Delete Account
                            </a>

                            <div class="border-t border-gray-200 my-1"></div>

                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 text-left">
                                    <svg class="mr-3 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
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
