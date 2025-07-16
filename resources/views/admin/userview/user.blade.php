@extends('layouts.admin')

@section('content')
<main class="flex-1 ml-64 py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Daftar User</h2>

            <!-- Search Bar -->
            <div class="mb-6">
                <form method="GET" action="{{ request()->url() }}" class="flex flex-col sm:flex-row items-start sm:items-center space-y-3 sm:space-y-0 sm:space-x-4">
                    <div class="relative flex-1 w-full sm:max-w-md">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Cari user berdasarkan nama atau email..." 
                               class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-colors duration-200">
                    </div>

                    <div class="flex space-x-2 w-full sm:w-auto">
                        <button type="submit" 
                                class="inline-flex items-center justify-center px-4 py-2 bg-slate-600 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md flex-1 sm:flex-none">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Cari
                        </button>

                        @if(request('search'))
                        <a href="{{ request()->url() }}" 
                           class="inline-flex items-center justify-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md flex-1 sm:flex-none">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Reset
                        </a>
                        @endif
                    </div>
                </form>

                @if(request('search'))
                <div class="mt-3 text-sm text-gray-600">
                    Hasil pencarian untuk: <span class="font-semibold text-gray-800">"{{ request('search') }}"</span>
                    <span class="text-gray-500">({{ $users->total() ?? count($users) }} hasil ditemukan)</span>
                </div>
                @endif
            </div>

            <!-- Table -->
            <div class="w-full overflow-hidden shadow-lg rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gradient-to-r from-slate-700 to-slate-800 text-white">
                            <tr>
                                <th class="px-3 sm:px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider whitespace-nowrap">No</th>
                                <th class="px-3 sm:px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider whitespace-nowrap">Nama</th>
                                <th class="px-3 sm:px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider whitespace-nowrap">Email</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($users as $index => $user)
                            <tr class="hover:bg-gray-50 transition-colors duration-200 {{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                                <td class="px-3 sm:px-6 py-4 text-center text-sm font-medium text-gray-900">
                                    {{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}
                                </td>
                                <td class="px-3 sm:px-6 py-4 text-sm text-gray-900">
                                    <div class="font-medium truncate">
                                        @if(request('search'))
                                            {!! str_ireplace(request('search'), '<mark class="bg-yellow-200 px-1 rounded">' . request('search') . '</mark>', $user->name) !!}
                                        @else
                                            {{ $user->name }}
                                        @endif
                                    </div>
                                </td>
                                <td class="px-3 sm:px-6 py-4 text-sm text-gray-900">
                                    <div class="font-medium truncate">
                                        @if(request('search'))
                                            {!! str_ireplace(request('search'), '<mark class="bg-yellow-200 px-1 rounded">' . request('search') . '</mark>', $user->email) !!}
                                        @else
                                            {{ $user->email }}
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-3 sm:px-6 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center space-y-3">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                        </svg>
                                        @if(request('search'))
                                            <p class="text-lg font-medium">Tidak ada user yang ditemukan</p>
                                            <p class="text-sm text-center">Coba gunakan kata kunci yang berbeda atau <a href="{{ request()->url() }}" class="text-slate-600 hover:text-slate-800 underline">reset pencarian</a></p>
                                        @else
                                            <p class="text-lg font-medium">Belum ada user terdaftar</p>
                                            <p class="text-sm text-center">User akan ditampilkan di sini ketika sudah terdaftar</p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if(isset($users) && method_exists($users, 'links'))
            <div class="mt-6 flex justify-center">
                {{ $users->appends(request()->query())->links() }}
            </div>
            @endif

        </div>
    </div>
</main>
@endsection
