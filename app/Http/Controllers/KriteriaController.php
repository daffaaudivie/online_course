<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;

class KriteriaController extends Controller
{
    public function index()
    {
        $dataKriteria = Kriteria::all();
        return view('admin.kriteria.kriteria', compact('dataKriteria'));
    }
}
