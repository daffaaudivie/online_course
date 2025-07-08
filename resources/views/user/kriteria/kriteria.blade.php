@extends('layouts.user')

@section('content')
<main class="flex-1 ml-84 py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Daftar Kriteria</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg overflow-hidden border border-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium">No</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Kode</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Nama Kriteria</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Nilai Ideal</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Faktor</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($dataKriteria as $index => $kriteria)
                        <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }}">
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">{{ $kriteria->kode_kriteria }}</td>
                            <td class="px-6 py-4">{{ $kriteria->nama_kriteria }}</td>
                            <td class="px-6 py-4">{{ number_format($kriteria->nilai_ideal, 2) }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full {{ $kriteria->faktor_inti ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-800' }}">
                                    {{ $kriteria->faktor_inti ? 'Inti' : 'Sekunder' }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
