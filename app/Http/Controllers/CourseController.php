<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Online_course;
use App\Imports\CourseImport;
use App\Exports\CourseExport;
use Maatwebsite\Excel\Facades\Excel;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Online_course::all();
        return view('admin.course.course', compact('courses'));
    }

    public function userView()
    {
        $courses = Online_course::all();
        return view('user.course.course', compact('courses'));
    }

    public function create()
    {
        return view('admin.course.create_course');
    }

    public function store(Request $request)
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

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Course::create($request->all());
            return redirect()->route('course.index')
                ->with('success', 'Data course berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $course = Online_course::findOrFail($id);
        return view('course.edit_course', compact('course'));
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

        $course = Online_course::findOrFail($id);
        $course->update($validated);

        return redirect()->route('course.index')->with('success', 'Course berhasil diperbarui!');
    }

    public function destroy($id_online_course)
        {
            $course = Online_course::findOrFail($id_online_course);
            $course->delete();

            return redirect()->route('course.index')->with('success', 'Course berhasil dihapus!');
        }

        public function downloadTemplate()
    {
        return Excel::download(new CourseExport, 'template_course.xlsx');
    }

    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'excel_file' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->with('error', 'File tidak valid. Pastikan file berformat Excel (.xlsx atau .xls) dan ukuran maksimal 2MB.');
        }

        try {
            $import = new CourseImport();
            Excel::import($import, $request->file('excel_file'));

            $successCount = $import->getSuccessCount();
            $errorCount = $import->getErrorCount();
            $errors = $import->getErrors();

            if ($errorCount > 0) {
                $message = "Import selesai dengan {$successCount} data berhasil dan {$errorCount} data gagal.";
                return redirect()->route('course.index')
                    ->with('warning', $message)
                    ->with('import_errors', $errors);
            }

            return redirect()->route('course.index')
                ->with('success', "Import berhasil! {$successCount} data course telah ditambahkan.");

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat import: ' . $e->getMessage());
        }
    }
}
