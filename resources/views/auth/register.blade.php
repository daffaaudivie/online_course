<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Rekomendasi Online Course</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-600 rounded-full mb-4">
                <i class="fas fa-graduation-cap text-white text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Sistem Rekomendasi Online Course</h1>
        </div>

        <!-- Register Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Buat Akun Baru</h2>
                <p class="text-gray-600 text-sm">Silakan lengkapi form berikut untuk mendaftar</p>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mb-4 p-3 text-sm text-red-700 bg-red-50 rounded-lg border border-red-200">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Lengkap
                    </label>
                    <div class="relative">
                        <input 
                            id="name" 
                            type="text" 
                            name="name" 
                            value="{{ old('name') }}"
                            required 
                            autofocus 
                            autocomplete="name"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 pl-11"
                            placeholder="Masukkan nama lengkap"
                        />
                        <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email
                    </label>
                    <div class="relative">
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            required 
                            autocomplete="username"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 pl-11"
                            placeholder="masukkan@email.com"
                        />
                        <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="new-password"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 pl-11 pr-11"
                            placeholder="Masukkan password"
                        />
                        <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <button 
                            type="button" 
                            id="toggle-password"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none"
                        >
                            <i class="fas fa-eye" id="eye-icon"></i>
                        </button>
                    </div>
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Konfirmasi Password
                    </label>
                    <div class="relative">
                        <input 
                            id="password_confirmation" 
                            type="password" 
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 pl-11 pr-11"
                            placeholder="Konfirmasi password"
                        />
                        <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <button 
                            type="button" 
                            id="toggle-password-confirm"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none"
                        >
                            <i class="fas fa-eye" id="eye-icon-confirm"></i>
                        </button>
                    </div>
                </div>

                <!-- Terms and Privacy Policy -->
                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="flex items-start">
                        <input 
                            type="checkbox" 
                            name="terms" 
                            id="terms" 
                            required
                            class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500 focus:ring-2 mt-1"
                        />
                        <label for="terms" class="ml-2 text-sm text-gray-600">
                            Saya menyetujui 
                            <a target="_blank" href="{{ route('terms.show') }}" class="text-indigo-600 hover:text-indigo-500 font-medium">
                                Syarat & Ketentuan
                            </a>
                            dan 
                            <a target="_blank" href="{{ route('policy.show') }}" class="text-indigo-600 hover:text-indigo-500 font-medium">
                                Kebijakan Privasi
                            </a>
                        </label>
                    </div>
                @endif

                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-200 font-medium"
                >
                    Daftar
                </button>

                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-500 font-medium">
                            Masuk sekarang
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 text-sm text-gray-500">
            <p>&copy; 2025 Sistem Rekomendasi Online Course. All rights reserved.</p>
        </div>
    </div>

    <script>
        // Password toggle functionality for password field
        const togglePassword = document.getElementById('toggle-password');
        const passwordField = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');

        if (togglePassword && passwordField && eyeIcon) {
            togglePassword.addEventListener('click', function() {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                
                // Toggle eye icon
                if (type === 'text') {
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                } else {
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                }
            });
        }

        // Password toggle functionality for confirm password field
        const togglePasswordConfirm = document.getElementById('toggle-password-confirm');
        const passwordConfirmField = document.getElementById('password_confirmation');
        const eyeIconConfirm = document.getElementById('eye-icon-confirm');

        if (togglePasswordConfirm && passwordConfirmField && eyeIconConfirm) {
            togglePasswordConfirm.addEventListener('click', function() {
                const type = passwordConfirmField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordConfirmField.setAttribute('type', type);
                
                // Toggle eye icon
                if (type === 'text') {
                    eyeIconConfirm.classList.remove('fa-eye');
                    eyeIconConfirm.classList.add('fa-eye-slash');
                } else {
                    eyeIconConfirm.classList.remove('fa-eye-slash');
                    eyeIconConfirm.classList.add('fa-eye');
                }
            });
        }

        // Input focus effects
        const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-indigo-500');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-indigo-500');
            });
        });
    </script>
</body>
</html>