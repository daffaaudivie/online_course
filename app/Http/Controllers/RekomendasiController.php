<?php

namespace App\Http\Controllers;

use App\Helpers\ProfileMatchingHelper;
use App\Models\OnlineCourse;
use App\Models\RekomendasiHistory;
use App\Models\RekomendasiDetail;
use App\Exports\DetailRekomendasiExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RekomendasiController extends Controller
{
    public function form()
    {
        $kategori = OnlineCourse::select('kategori')->distinct()->pluck('kategori');
        $tipe = OnlineCourse::select('tipe')->distinct()->pluck('tipe');
        $bahasa = OnlineCourse::select('bahasa')->distinct()->pluck('bahasa');
        $level = OnlineCourse::select('level')->distinct()->pluck('level');
        $platform = OnlineCourse::select('platform')->distinct()->pluck('platform');
        
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

    $courses = OnlineCourse::all();
    $hasil = [];

    // Nilai ideal sesuai urutan kriteria
    $nilaiIdeal = [5, 4, 5, 3, 3, 3, 3, 3, 3];
    $labelKriteria = ['Kategori', 'Harga', 'Rating', 'Viewers', 'Bahasa', 'Tipe', 'Level', 'Durasi', 'Platform'];

    foreach ($courses as $course) {
        // Konversi nilai aktual
        $nilaiAktual = [
            ProfileMatchingHelper::convertKategori($course->kategori, $preferensi['kategori']),
            ProfileMatchingHelper::convertHargaToActual($course->harga, $preferensi['harga']),
            ProfileMatchingHelper::convertRatingToActual($course->rating, $preferensi['rating']),
            ProfileMatchingHelper::convertViewersToActual($course->jumlah_viewers, $preferensi['viewers']),
            ProfileMatchingHelper::convertBahasa($course->bahasa, $preferensi['bahasa']),
            ProfileMatchingHelper::convertTipe($course->tipe, $preferensi['tipe']),
            ProfileMatchingHelper::convertLevel($course->level, $preferensi['level']),
            ProfileMatchingHelper::convertDurasi(
                ProfileMatchingHelper::normalizeDurasi($course->durasi), 
                $preferensi['durasi']
            ),
            ProfileMatchingHelper::convertPlatform($course->platform, $preferensi['platform']),
        ];

        // === DEBUG LOGGING ===
        Log::info("=== DEBUG COURSE: {$course->judul} ===");
        Log::info("Data Mentah:", [
            'kategori' => $course->kategori,
            'harga' => $course->harga,
            'rating' => $course->rating,
            'viewers' => $course->jumlah_viewers,
            'bahasa' => $course->bahasa,
            'tipe' => $course->tipe,
            'level' => $course->level,
            'durasi' => $course->durasi,
            'platform' => $course->platform,
        ]);
        foreach ($nilaiAktual as $i => $actual) {
            $gap = $actual - $nilaiIdeal[$i];
            Log::info("{$labelKriteria[$i]} | Aktual = {$actual} | Ideal = {$nilaiIdeal[$i]} | GAP = {$gap}");
        }

        // Hitung skor total
        $totalSkor = ProfileMatchingHelper::hitungSkor($nilaiAktual, $nilaiIdeal);

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
            'skor' => round($totalSkor, 5),
            'nilai_aktual' => $nilaiAktual,
            'gap' => array_map(fn($i) => $nilaiAktual[$i] - $nilaiIdeal[$i], range(0, 8))
        ];
    }

    $rekomendasi = collect($hasil)->sortByDesc('skor')->take(10)->values();
    $courses = $rekomendasi;

    session([
        'rekomendasi_result' => $rekomendasi,
        'rekomendasi_filter' => $preferensi
    ]);

    $kategori = OnlineCourse::select('kategori')->distinct()->pluck('kategori');
    $tipe = OnlineCourse::select('tipe')->distinct()->pluck('tipe');
    $bahasa = OnlineCourse::select('bahasa')->distinct()->pluck('bahasa');
    $level = OnlineCourse::select('level')->distinct()->pluck('level');
    $platform = OnlineCourse::select('platform')->distinct()->pluck('platform');

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

        // session()->forget(['rekomendasi_result', 'rekomendasi_filter']);

        return redirect()->route('rekomendasi.riwayat')->with('success', 'Rekomendasi berhasil disimpan.');


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

    public function exportPDF($id)
{
    $history = RekomendasiHistory::with('details.course')->findOrFail($id);

    $pdf = Pdf::loadView('exports.rekomendasi_pdf', compact('history'))
              ->setPaper('a4', 'portrait');   // atur ukuran kertas bila perlu

    return $pdf->download('rekomendasi-'.now()->format('Ymd_His').'.pdf');
}
public function export(Request $request, $id)
{
    $history = RekomendasiHistory::with('details.course')->findOrFail($id);

    // Jika query ?download=pdf ada → unduh PDF
    if ($request->query('download') === 'pdf') {
        return Pdf::loadView('exports.rekomendasi_pdf', ['history' => $history])
                  ->setPaper('a4', 'portrait')
                  ->download('rekomendasi-' . now()->format('Ymd_His') . '.pdf');
    }

    // Tanpa query → tampilkan pratinjau HTML
    return view('exports.rekomendasi_pdf', [
        'history'    => $history,
        'isPreview'  => true      // flag agar tombol muncul hanya di preview
    ]);
}
public function exportPreview($id)
{
    $history = RekomendasiHistory::with('details.course')->findOrFail($id);
    return view('exports.rekomendasi_pdf', compact('history'));
}
public function exportExcel($id)
{
    $history = RekomendasiHistory::with('details.course')->findOrFail($id);

    $courses = $history->details->map(function ($detail) {
        return $detail->course;
    });

    return Excel::download(new DetailRekomendasiExport($courses), 'rekomendasi-course.xlsx');
}
}