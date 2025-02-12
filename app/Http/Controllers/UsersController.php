<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Menampilkan daftar user.
     */
    public function index()
    {
        $users = User::all(); 
        return view('features.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        if ($user->role === 'admin') {
            return redirect()->route('users.index')->with('error', 'Tidak dapat mengubah role admin.');
        }
        return view('features.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:pengguna,laboran,teknisi',
        ]);

        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return redirect()->route('users.index')->with('error', 'Tidak dapat mengubah role admin.');
        }

        $user->role = $request->role;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Role pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

    // Cek apakah role adalah admin
        if ($user->role === 'admin') {
            return redirect()->route('users.index')
                ->with('error', 'Pengguna dengan role admin tidak dapat dihapus.');
        }

        // Hapus pengguna
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
        }
}
