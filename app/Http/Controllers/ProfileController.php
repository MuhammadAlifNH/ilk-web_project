<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Tampilkan form profil pengguna.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Perbarui informasi profil pengguna.
     */
    public function update(Request $request): RedirectResponse
    {
        // Validasi input termasuk field phone
        $data = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['nullable', 'regex:/^[0-9]+$/', 'max:13'], // Validasi field phone
            'role' => ['required', 'string', Rule::in(['admin', 'laboran', 'teknisi', 'pengguna'])],
            'admin_code' => ['nullable', 'string'],
        ]);

        // Validasi kode admin
        if ($request->role === 'admin') {
            $adminCode = env('ADMIN_VERIFICATION_CODE', '123abc'); // Simpan kode di .env
            if ($request->verification_code !== $adminCode) {
                return back()->withErrors(['admin_code' => 'Kode verifikasi salah.']);
            }
        }
        elseif ($request->role === 'laboran') {
            $laboranCode = env('LABORAN_VERIFICATION_CODE', '456def'); // Simpan kode di .env
            if ($request->verification_code !== $laboranCode) {
                return back()->withErrors(['laboran_code' => 'Kode verifikasi salah.']);
            }
        }
        elseif ($request->role === 'teknisi') {
            $teknisiCode = env('TEKNISI_VERIFICATION_CODE', '789ghi'); // Simpan kode di .env
            if ($request->verification_code !== $teknisiCode) {
                return back()->withErrors(['teknisi_code' => 'Kode verifikasi salah.']);
            }
        }
        
        $user = $request->user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
        ]);

        // Jika email berubah, reset verifikasi email
        if ($user->email !== $data['email']) {
            $user->email_verified_at = null;
        }

        // Isi data pengguna dengan data yang telah divalidasi (termasuk phone)
        $user->fill($data);
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Hapus akun pengguna.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validasi password untuk penghapusan akun
        $request->validate([
            'password' => ['required', 'current_password'],
        ], [], 'userDeletion');

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
