<?php

namespace App\Http\Controllers;

use App\Helpers\ProfileMatchingHelper;
use App\Models\Online_course;
use App\Models\RekomendasiHistory;
use App\Models\RekomendasiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RekomendasiController extends Controller
{
    public function form()
    {
        $kategori = Online_course::select('kategori')->distinct()->pluck('kategori');
        $tipe = Online_course::select('tipe')->distinct()->pluck('tipe');
        $bahasa = Online_course::select('bahasa')->distinct()->pluck('bahasa');
        $level = Online_course::select('level')->distinct()->pluck('level');
        $platform = Online_course::select('platform')->distinct()->pluck('platform');
        
        // Add empty courses collection
        $courses = collect([]);

        return view('user.rekomendasi.rekomendasi', compact(
            'kategori', 'tipe', 'bahasa', 'level', 'platform', 'courses'
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

            $nilaiIdeal = [5, 4, 5, 3, 3, 3, 3, 3, 3];
            $bobotInterpolasi = [];

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

                $interpolasi = ProfileMatchingHelper::interpolate($bobot, 1, 5, 3, 5);
                $bobotInterpolasi[] = $interpolasi;
            }

            $cf = array_sum(array_slice($bobotInterpolasi, 0, 5)) / 5;
            $sf = array_sum(array_slice($bobotInterpolasi, 5, 4)) / 4;
            $totalSkor = (0.7 * $cf) + (0.3 * $sf);

            $hasil[] = [
                'id' => $course->id_online_course,
                'judul' => $course->judul,
                'link' => $course->link,
                'deskripsi' => $course->deskripsi,
                'kategori' => $course->kategori,
                'tipe' => $course->tipe,
                'harga' => $course->harga,
                'bahasa' => $course->bahasa,
                'level' => $course->level,
                'rating' => $course->rating,
                'jumlah_viewers' => $course->jumlah_viewers,
                'durasi' => $course->durasi,
                'platform' => $course->platform,
                'skor' => round($totalSkor, 4),
            ];
        }

        $rekomendasi = collect($hasil)->sortByDesc('skor')->take(10)->values();
        $courses = $rekomendasi; // Use the same variable name

        // Simpan sementara di session (belum disimpan ke DB)
        session(['rekomendasi_result' => $rekomendasi, 'rekomendasi_filter' => $preferensi]);

        $kategori = Online_course::select('kategori')->distinct()->pluck('kategori');
        $tipe = Online_course::select('tipe')->distinct()->pluck('tipe');
        $bahasa = Online_course::select('bahasa')->distinct()->pluck('bahasa');
        $level = Online_course::select('level')->distinct()->pluck('level');
        $platform = Online_course::select('platform')->distinct()->pluck('platform');

        return view('user.rekomendasi.rekomendasi', compact(
            'rekomendasi', 'kategori', 'tipe', 'bahasa', 'level', 'platform', 'courses'
        ));
    }

    public function simpan()
    {
        $rekomendasi = session('rekomendasi_result');
        $preferensi = session('rekomendasi_filter');

        if (!$rekomendasi || !$preferensi) {
            return redirect()->back()->with('error', 'Data rekomendasi tidak tersedia.');
        }

        $userId = Auth::id(); // pastikan tidak null
        if (!$userId) {
            return redirect()->back()->with('error', 'Anda belum login.');
        }

        $history = RekomendasiHistory::create([
            'user_id' => $userId,
            'filter' => json_encode($preferensi),
        ]);

        foreach ($rekomendasi as $item) {
            RekomendasiDetail::create([
                'rekomendasi_history_id' => $history->id,
                'online_course_id' => $item['id'],
                'skor' => $item['skor'],
            ]);
        }

        session()->forget(['rekomendasi_result', 'rekomendasi_filter']);

        return redirect()->back()->with('success', 'Rekomendasi berhasil disimpan.');
    }

    public function riwayat()
    {
        // PERBAIKAN: Filter berdasarkan user yang sedang login
        $riwayats = RekomendasiHistory::where('user_id', Auth::id())
                                    ->latest()
                                    ->paginate(10);
        
        return view('user.rekomendasi.riwayat', compact('riwayats'));
    }

    public function riwayatDetail($id)
    {
        // PERBAIKAN: Filter berdasarkan user yang sedang login untuk keamanan
        $history = RekomendasiHistory::where('user_id', Auth::id())
                                   ->where('id', $id)
                                   ->with('details.course')
                                   ->firstOrFail();

        return view('user.rekomendasi.riwayat_detail', compact('history'));
    }

    public function riwayatDelete($id)
    {
        // PERBAIKAN: Filter berdasarkan user yang sedang login untuk keamanan
        $history = RekomendasiHistory::where('user_id', Auth::id())
                                   ->where('id', $id)
                                   ->firstOrFail();

        // Hapus detail terlebih dahulu
        DB::table('rekomendasi_detail')->where('rekomendasi_history_id', $id)->delete();

        // Hapus history
        $history->delete();

        return redirect()->route('rekomendasi.riwayat')->with('success', 'Riwayat berhasil dihapus.');
    }
}