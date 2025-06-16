<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="flex">
        {{-- Sidebar --}}
        @include('layouts.sidebar_admin')

        {{-- Konten utama --}}
        <div class="flex-1 flex flex-col min-h-screen">
            {{-- Header --}}
            @include('layouts.header_admin')

            {{-- Konten --}}
            <main class="flex-1 p-4">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
