<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Rekomendasi Course</title>

    <style>
        body           { font-family: DejaVu Sans, sans-serif; font-size: 12px; color:#333; }
        h1, h2         { margin: 0 0 8px 0; }
        .header        { text-align:center; margin-bottom: 25px; }

        .pref-table    { width:100%; border-collapse:collapse; margin-bottom:25px; }
        .pref-table td { padding:6px 8px; border-bottom:1px solid #dcdcdc; vertical-align:top; }
        .pref-table td.key { width:30%; text-transform:capitalize; font-weight:600; }

        .course-table  { width:100%; border-collapse:collapse; }
        .course-table th,
        .course-table td { border:1px solid #4a4a4a; padding:6px 8px; }
        .course-table th { background:#f2f2f2; }
        .text-center   { text-align:center; }
        a              { color:#0d6efd; text-decoration:none; }

        /* Tombol Print (khusus layar saja, tidak ikut tercetak) */
        .print-btn {
            margin-bottom: 20px;
            display: inline-block;
            padding: 8px 14px;
            background: #2563eb;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
        }

        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>
<body>

    <!-- Tombol print -->
    <a href="#" class="print-btn" onclick="window.print()">🖨 Print Halaman Ini</a>

    <div class="header">
        <h1>Laporan Rekomendasi Course</h1>
        <p>Tanggal cetak: {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
    </div>

    @php
        $preferences = json_decode($history->filter, true);
    @endphp

    <h2>Preferensi Pengguna</h2>
    <table class="pref-table">
        @foreach($preferences as $key => $value)
            @if(!empty($value))
                <tr>
                    <td class="key">{{ str_replace('_', ' ', $key) }}</td>
                    <td>
                        @if(is_array($value))
                            {{ implode(', ', $value) }}
                        @else
                            {{ $value }}
                        @endif
                    </td>
                </tr>
            @endif
        @endforeach
    </table>

    <h2>Daftar Course Rekomendasi</h2>
    <table class="course-table">
        <thead>
            <tr>
                <th style="width:5%;">No</th>
                <th style="width:45%;">Judul</th>
                <th style="width:20%;">Kategori</th>
                <th style="width:10%;">Skor</th>
                <th style="width:20%;">Link Course</th>
            </tr>
        </thead>
        <tbody>
            @foreach($history->details as $index => $detail)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $detail->course->judul }}</td>
                    <td>{{ $detail->course->kategori }}</td>
                    <td class="text-center">{{ number_format($detail->skor, 2) }}</td>
                    <td><a href="{{ $detail->course->link }}">{{ $detail->course->link }}</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Opsional: Auto-print saat halaman dibuka -->
    {{-- <script> window.onload = () => window.print(); </script> --}}

</body>
</html>
