<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OnlineCourse;
use App\Models\RekomendasiHistory;
use App\Models\Kriteria;
use App\Models\Favorite;
use App\Models\User;
use App\Imports\CourseImport;
use App\Exports\CourseExport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index(Request $request)
{
    $query = OnlineCourse::query(); // Inisialisasi query builder

    if ($request->has('search') && $request->search != '') {
        $searchTerm = $request->search;

        $query->where(function ($q) use ($searchTerm) {
            $q->where('judul', 'like', '%' . $searchTerm . '%')
              ->orWhere('kategori', 'like', '%' . $searchTerm . '%');
        });
    }

    $courses = $query->paginate(10);

    return view('admin.course.course', compact('courses'));
}

    public function dashboard()
{
    $user = Auth::user();

    // Total course
    $totalCourses = OnlineCourse::count();

    // Total favorit user
    $favoriteCourses = Favorite::where('user_id', $user->id)->count();

    // Total rekomendasi yang disimpan user
    $totalRecommendations = RekomendasiHistory::where('user_id', $user->id)->count();

    return view('dashboard', compact(
        'totalCourses',
        'favoriteCourses',
        'totalRecommendations'
    ));
}

    public function dashboardAdmin()
{
    $admin = Auth::guard('admin')->user(); // Perbaiki ini juga

    // Total course
    $totalCourses = OnlineCourse::count();
    $totalKriteria = Kriteria::count();
    $totalUsers = User::count();

    // Total rekomendasi yang disimpan user (jika diperlukan)
    // $totalRecommendations = RekomendasiHistory::where('user_id', $admin->id)->count();

    return view('dashboard_admin', compact(
        'totalCourses',
        'totalKriteria',
        'totalUsers'
        // 'totalRecommendations' // tambahkan jika diperlukan
    ));
}

    public function userView(Request $request)
{
    $query = OnlineCourse::query(); // inisialisasi query

    if ($request->has('search') && $request->search != '') {
        $searchTerm = $request->search;
        $query->where(function($q) use ($searchTerm) {
            $q->where('judul', 'like', '%' . $searchTerm . '%')
              ->orWhere('kategori', 'like', '%' . $searchTerm . '%');
        });
    }

    $courses = $query->paginate(10);

    return view('user.course.course', compact('courses'));
}

    public function create()
    {
        return view('admin.course.create_course');
    }

    public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'judul' => 'required|string',
        'kategori' => 'required|string',
        'link' => 'required|url',
        'tipe' => 'nullable|string',
        'bahasa' => 'nullable|string',
        'level' => 'nullable|string',
        'rating' => 'nullable|numeric',
        'harga' => 'nullable|numeric',
        'jumlah_viewers' => 'nullable|integer',
        'durasi' => 'nullable|string',
        'platform' => 'nullable|string',
        'deskripsi' => 'nullable|string',
    ]);

    try {
        // Tampilkan log isi data yang akan disimpan
        Log::info('Data course yang akan disimpan:', $validated);

        // Simpan data ke database
        $course = OnlineCourse::create($validated);

        // Cek hasil simpan (debug tambahan)
        Log::info('Course berhasil disimpan dengan ID: ' . $course->id_online_course);

        return redirect()->route('course.index')
            ->with('success', 'Data course berhasil ditambahkan!');
    } catch (\Exception $e) {
        // Tampilkan log error
        Log::error('Gagal menyimpan course: ' . $e->getMessage());

        return redirect()->back()
            ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
            ->withInput();
    }
}


    public function edit($id)
    {
        $course = OnlineCourse::findOrFail($id);
        return view('admin.course.edit_course', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => 'required|string',
            'kategori' => 'required|string',
            'link' => 'required|url',
            'tipe' => 'nullable|string',
            'bahasa' => 'nullable|string',
            'level' => 'nullable|string',
            'rating' => 'nullable|numeric',
            'harga' => 'nullable|numeric',
            'jumlah_viewers' => 'nullable|integer',
            'durasi' => 'nullable|string',
            'platform' => 'nullable|string',
            'deskripsi' => 'nullable|string',
        ]);

        $course = OnlineCourse::findOrFail($id);
        $course->update($validated);

        return redirect()->route('course.index')->with('success', 'Course berhasil diperbarui!');
    }

    public function destroy($id_online_course)
    {
        $course = OnlineCourse::findOrFail($id_online_course);
        $course->delete();

        return redirect()->route('course.index')->with('success', 'Course berhasil dihapus!');
    }

    public function downloadTemplate()
    {
        return Excel::download(new CourseExport, 'template_course.xlsx');
    }

    public function import(Request $request)
    {
        try {
            // Validasi file upload
            $request->validate([
                'excel_file' => 'required|file|mimes:xlsx,xls|max:10240', // Max 10MB
            ]);

            Log::info("=== STARTING IMPORT DEBUG ===");
            
            $file = $request->file('excel_file');
            
            // Debug informasi file
            Log::info("File info:", [
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'extension' => $file->getClientOriginalExtension(),
                'is_valid' => $file->isValid()
            ]);

            // Pastikan file valid
            if (!$file->isValid()) {
                throw new \Exception('File upload tidak valid');
            }

            // Import dengan explicit reader type
            $import = new CourseImport();
            Excel::import($import, $file, null, \Maatwebsite\Excel\Excel::XLSX);
            
            // Log hasil
            Log::info("=== IMPORT COMPLETED ===");
            Log::info("Processed rows: " . $import->getProcessedRows());
            Log::info("Success count: " . $import->getSuccessCount());
            Log::info("Error count: " . $import->getErrorCount());
            Log::info("Debug info: " . json_encode($import->getDebugInfo()));
            
            // Cek data di database
            $totalRecords = OnlineCourse::count();  // Perbaiki nama tabel
            Log::info("Total records in database: " . $totalRecords);

            // Return dengan redirect untuk web form
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Import berhasil!',
                    'processed' => $import->getProcessedRows(),
                    'success' => $import->getSuccessCount(),
                    'errors' => $import->getErrorCount(),
                    'debug' => $import->getDebugInfo(),
                    'total_in_db' => $totalRecords
                ]);
            } else {
                $message = "Import berhasil! " . $import->getSuccessCount() . " data berhasil diimpor.";
                if ($import->getErrorCount() > 0) {
                    $message .= " " . $import->getErrorCount() . " data gagal diimpor.";
                }
                
                return redirect()->route('course.index')
                    ->with('success', $message);
            }
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error("VALIDATION ERROR: " . json_encode($e->errors()));
            
            return redirect()->back()
                ->withErrors($e->errors())
                ->with('error', 'File tidak valid. Pastikan mengupload file Excel (.xlsx/.xls)');
                
        } catch (\Exception $e) {
            Log::error("IMPORT EXCEPTION: " . $e->getMessage());
            Log::error("Stack trace: " . $e->getTraceAsString());
            
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => $e->getMessage(),
                    'line' => $e->getLine(),
                    'file' => $e->getFile()
                ], 500);
            } else {
                return redirect()->back()
                    ->with('error', 'Terjadi kesalahan saat import: ' . $e->getMessage());
            }
        }
    }
}