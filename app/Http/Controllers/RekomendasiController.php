<?php

namespace App\Http\Controllers;

use App\Helpers\ProfileMatchingHelper;
use App\Models\Online_course;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    public function form()
    {
        $kategori = Online_course::select('kategori')->distinct()->pluck('kategori');
        $tipe = Online_course::select('tipe')->distinct()->pluck('tipe');
        $bahasa = Online_course::select('bahasa')->distinct()->pluck('bahasa');
        $level = Online_course::select('level')->distinct()->pluck('level');
        $platform = Online_course::select('platform')->distinct()->pluck('platform');

        return view('user.rekomendasi.rekomendasi', compact(
            'kategori', 'tipe', 'bahasa', 'level', 'platform'
        ));
    }

    public function proses(Request $request)
{
    $preferensi = $request->only([
        'kategori', 'harga', 'rating', 'viewers', 'bahasa',
        'tipe', 'level', 'durasi', 'platform'
    ]);

    $courses = Online_course::all();

    $hasil = [];

    foreach ($courses as $course) {
        // Langkah 1: Hitung nilai aktual course berdasarkan preferensi user
        $nilaiAktual = [
            ProfileMatchingHelper::convertKategori($course->kategori, $preferensi['kategori']),
            ProfileMatchingHelper::convertHargaToActual($course->harga, $preferensi['harga']),
            ProfileMatchingHelper::convertRatingToActual($course->rating, $preferensi['rating']),
            ProfileMatchingHelper::convertViewersToActual($course->jumlah_viewers, $preferensi['viewers']),
            ProfileMatchingHelper::convertBahasa($course->bahasa, $preferensi['bahasa']),
            ProfileMatchingHelper::convertTipe($course->tipe, $preferensi['tipe']),
            ProfileMatchingHelper::convertLevel($course->level, $preferensi['level']),
            ProfileMatchingHelper::convertDurasi(ProfileMatchingHelper::normalizeDurasi($course->durasi)),
            ProfileMatchingHelper::convertPlatform($course->platform, $preferensi['platform']),
        ];

        // Langkah 2: Nilai ideal untuk setiap kriteria
        $nilaiIdeal = [5, 4, 5, 3, 3, 3, 3, 3, 3];

        $bobotInterpolasi = [];

        // Langkah 3: Hitung GAP, konversi ke bobot, lalu interpolasi
        foreach ($nilaiAktual as $i => $nilai) {
            $gap = $nilai - $nilaiIdeal[$i];
            $bobot = match ($gap) {
                0 => 5,
                1 => 4.5,
                -1 => 4,
                2 => 3.5,
                -2 => 3,
                3 => 2.5,
                -3 => 2,
                4 => 1.5,
                -4 => 1,
                default => 0
            };

            // Interpolasi linear skala 3–5
            $interpolasi = ProfileMatchingHelper::interpolate($bobot, 1, 5, 3, 5);
            $bobotInterpolasi[] = $interpolasi;
        }

        // Langkah 4: Hitung Core Factor (CF) dan Secondary Factor (SF)
        $cf = array_sum(array_slice($bobotInterpolasi, 0, 5)) / 5;
        $sf = array_sum(array_slice($bobotInterpolasi, 5, 4)) / 4;

        // Langkah 5: Skor akhir = 70% CF + 30% SF
        $totalSkor = (0.7 * $cf) + (0.3 * $sf);

        $hasil[] = [
            'judul' => $course->judul,
            'kategori' => $course->kategori,
            'platform' => $course->platform,
            'rating' => $course->rating,
            'harga' => $course->harga,
            'skor' => round($totalSkor, 4),
            'id' => $course->id_online_course
        ];
    }

    // Ambil 10 rekomendasi teratas berdasarkan skor
    $rekomendasi = collect($hasil)->sortByDesc('skor')->take(10);

    // Ambil ulang data dropdown untuk tampilan form
    $kategori = Online_course::select('kategori')->distinct()->pluck('kategori');
    $tipe = Online_course::select('tipe')->distinct()->pluck('tipe');
    $bahasa = Online_course::select('bahasa')->distinct()->pluck('bahasa');
    $level = Online_course::select('level')->distinct()->pluck('level');
    $platform = Online_course::select('platform')->distinct()->pluck('platform');

    return view('user.rekomendasi.rekomendasi', compact(
        'rekomendasi', 'kategori', 'tipe', 'bahasa', 'level', 'platform'
    ));
}

}
