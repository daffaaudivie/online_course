<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>User Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 bg-slate-800 text-white flex flex-col">
            @include('layouts.sidebar')
        </aside>

        {{-- Konten utama --}}
        <div class="flex-1 flex flex-col">
            {{-- Header --}}
            @include('layouts.header')

            {{-- Konten --}}
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
