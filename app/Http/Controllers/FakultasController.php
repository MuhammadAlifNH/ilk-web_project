<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FakultasController extends Controller
{
    public function index()
    {
        // Ambil data fakultas
        $fakultas = Fakultas::all();

        return view('features.fakultas.index', compact('fakultas'));
    }

    public function create()
    {
        return view('features.fakultas.create');
    }

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'nama_fakultas' => 'required|string|max:255',
        ]);

        // Simpan data dan otomatis mencatat user_id
        Fakultas::create([
            'nama_fakultas' => $request->nama_fakultas,
            'user_id'       => Auth::user()->id, // Pastikan user sudah login
        ]);

        return redirect()->route('fakultas.index')->with('success', 'Data fakultas berhasil ditambahkan');
    }

    public function destroy(Fakultas $fakultas)
    {
        // Hapus data
        $fakultas->delete();

        return redirect()->back()->with('success', 'Data fakultas berhasil dihapus');
    }
}
