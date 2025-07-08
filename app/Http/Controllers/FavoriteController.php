<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\OnlineCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Tambah course ke favorites
     */
    public function store($id_online_course)
{
    $user = Auth::user();

    // Cek apakah course sudah ada di favorites
    $existingFavorite = $user->favorites()->where('favorites.id_online_course', $id_online_course)->exists();

    if (!$existingFavorite) {
        $user->favorites()->attach($id_online_course);

        // Cek jika request dari AJAX (fetch)
        if (request()->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Course berhasil ditambahkan ke favorites!']);
        }

        return redirect()->back()->with('success', 'Course berhasil ditambahkan ke favorites!');
    }

    if (request()->wantsJson()) {
        return response()->json(['success' => false, 'message' => 'Course sudah ada di favorites!'], 409);
    }

    return redirect()->back()->with('info', 'Course sudah ada di favorites!');
}

public function destroy($id_online_course)
{
    $user = Auth::user();

    $user->favorites()->detach($id_online_course);

    if (request()->wantsJson()) {
        return response()->json(['success' => true, 'message' => 'Course berhasil dihapus dari favorites!']);
    }

    return redirect()->back()->with('success', 'Course berhasil dihapus dari favorites!');
}

public function favoriteCourses()
{
    $user = auth()->user();
    $favoriteCourses = $user->favorites()->paginate(10); // atau get()

    return view('user.favorite.favorite', compact('favoriteCourses'));
}


    /**
     * Tampilkan halaman favorites user
     */
    public function index()
        {
            $user = Auth::user();
            $favoriteCourses = $user->favorites()->paginate(10);

            return view('user.favorite.favorite', compact('favoriteCourses'));
        }
}