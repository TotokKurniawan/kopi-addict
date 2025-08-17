<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $user = Auth::user(); // pastikan user login

        $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update nama
        $user->nama = $request->input('nama');

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path(path: 'uploads/foto'), $filename);
            $user->foto = $filename;
        }

        $user->save();
        return back()->with('success', 'Profil berhasil diperbarui.');
    }
    public function updateProfileadmin(Request $request)
    {
        $user = Auth::user(); // pastikan user login

        $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update nama
        $user->nama = $request->input('nama');

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/foto'), $filename);
            $user->foto = $filename;
        }

        $user->save();
        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
