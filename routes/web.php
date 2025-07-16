<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\RekomendasiController;
use Illuminate\Support\Facades\DB;


Route::get('/', function () {
    return view('auth.login');
});

// Auth routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// User routes (menggunakan guard default/web)
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [CourseController::class, 'dashboard'])->name('dashboard');
});


Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/courses', [CourseController::class, 'userView'])->name('user.courses');
    Route::post('/favorites/{id_online_course}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{id_online_course}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::get('/rekomendasi', [RekomendasiController::class, 'form'])->name('rekomendasi.form');
    Route::post('/rekomendasi', [RekomendasiController::class, 'proses'])->name('rekomendasi.proses');
    Route::get('/riwayat-rekomendasi', [RekomendasiController::class, 'riwayat'])->name('rekomendasi.riwayat');
    Route::get('/riwayat-rekomendasi/{id}', [RekomendasiController::class, 'riwayatDetail'])->name('rekomendasi.riwayat.detail');
    Route::get('/rekomendasi/riwayat/{id}', [RekomendasiController::class, 'riwayatDetail'])->name('rekomendasi.riwayat.detail');
    Route::post('/rekomendasi/simpan', [RekomendasiController::class, 'simpan'])->name('rekomendasi.simpan');
    Route::delete('/rekomendasi/riwayat/{id}', [RekomendasiController::class, 'riwayatDelete'])->name('rekomendasi.riwayat.delete'); 
     Route::get('/kriteria', [KriteriaController::class, 'indexUser'])->name('kriteria.indexUser');
     Route::get('/rekomendasi/{id}/export-pdf', [RekomendasiController::class, 'exportPDF'])->name('rekomendasi.export.pdf');
     Route::get('/user/rekomendasi/{id}/export', [RekomendasiController::class, 'export'])
     ->name('rekomendasi.export');
     Route::get('/rekomendasi/{id}/export', [RekomendasiController::class, 'exportPreview'])->name('rekomendasi.export');
     Route::get('/user/rekomendasi/{id}/export-excel', [App\Http\Controllers\RekomendasiController::class, 'exportExcel'])->name('rekomendasi.export.excel');




});

// Admin routes (menggunakan guard admin)
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [CourseController::class, 'dashboardAdmin'])->name('dashboard_admin');
    Route::get('course/download/template', [CourseController::class, 'downloadTemplate'])
        ->name('course.download-template');
    Route::post('course/import/excel', [CourseController::class, 'import'])
        ->name('course.import');
    Route::get('admin/online_course/{id_online_course}/edit', [CourseController::class, 'edit'])->name('course.edit');
    Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
    Route::get('/users', [AdminController::class, 'userView'])->name('admin.userView');


    // ✅ Perbaikan: chaining parameter() di dalam resource() method
    Route::resource('online_course', CourseController::class)
        ->parameters(['online_course' => 'id_online_course'])
        ->names([
            'index' => 'course.index',
            'create' => 'course.create',
            'store' => 'course.store',
            'edit' => 'course.edit',
            'update' => 'course.update',
            'destroy' => 'course.destroy',
        ]);
});
