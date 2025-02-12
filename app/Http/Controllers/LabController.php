<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Labs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LabController extends Controller
{
    public function index()
    {
        $labs = Labs::with('fakultas', 'user')->get();
        return view('features.labs.index', compact('labs'));
    }

    public function create()
    {
        $fakultas = Fakultas::all();
        return view('features.labs.create', compact('fakultas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'nama_lab' => 'required|string|max:255',
            'jumlah_meja' => 'required|integer|min:1',
        ]);

        Labs::create([
            'fakultas_id' => $request->fakultas_id,
            'nama_lab' => $request->nama_lab,
            'user_id' => Auth::id(),
            'jumlah_meja' => $request->jumlah_meja,
        ]);

        return redirect()->route('labs.index')->with('success', 'Lab berhasil ditambahkan');
    }

    public function destroy(Labs $lab)
    {
        $lab->delete();
        return redirect()->back()->with('success', 'Data lab berhasil dihapus');
    }
}
