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
        // Validasi input termasuk field image (foto profil), name, email, phone, role, dan admin_code
        $data = $request->validate([
            'image' => ['nullable', 'image', 'max:2048'], // Maksimal 2MB
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['nullable', 'regex:/^[0-9]+$/', 'max:13'],
            'role'  => ['required', 'string', Rule::in(['admin', 'laboran', 'teknisi', 'pengguna'])],
            'admin_code' => ['nullable', 'string'],
            // Pastikan field verification_code ada jika diperlukan
        ]);
    
        // Validasi kode verifikasi berdasarkan role
        if ($request->role === 'admin') {
            $adminCode = env('ADMIN_VERIFICATION_CODE', '123abc');
            if ($request->verification_code !== $adminCode) {
                return back()->withErrors(['admin_code' => 'Kode verifikasi salah.']);
            }
        } elseif ($request->role === 'laboran') {
            $laboranCode = env('LABORAN_VERIFICATION_CODE', '456def');
            if ($request->verification_code !== $laboranCode) {
                return back()->withErrors(['laboran_code' => 'Kode verifikasi salah.']);
            }
        } elseif ($request->role === 'teknisi') {
            $teknisiCode = env('TEKNISI_VERIFICATION_CODE', '789ghi');
            if ($request->verification_code !== $teknisiCode) {
                return back()->withErrors(['teknisi_code' => 'Kode verifikasi salah.']);
            }
        }
    
        $user = $request->user();
        $oldEmail = $user->email;
    
        // Tangani upload atau penghapusan foto profil
        if ($request->hasFile('image')) {
            // Hapus foto lama jika ada
            if ($user->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->image);
            }
            // Simpan foto baru di folder 'images' pada disk 'public'
            $data['image'] = $request->file('image')->store('images', 'public');
        } elseif ($request->filled('remove_image')) {
            // Jika terdapat input untuk menghapus foto
            if ($user->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->image);
            }
            $data['image'] = null;
        } else {
            // Jika tidak ada perubahan pada foto, pertahankan nilai lama
            $data['image'] = $user->image;
        }
    
        // Jika email berubah, reset verifikasi email
        if ($oldEmail !== $data['email']) {
            $user->email_verified_at = null;
        }
    
        // Perbarui data user dengan data yang telah divalidasi
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
