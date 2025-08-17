<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{

    public function simpanPengguna(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
            'password' => 'required|string|min:6',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = new \App\Models\User();
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/foto'), $filename);
            $user->foto = $filename;
        }

        $user->save();

        return redirect()->route('pengguna')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function updatePengguna(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->role = $request->role;

        // Update foto jika ada
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path(path: 'uploads/foto'), $filename);
            $user->foto = $filename;
        }

        $user->save();

        return redirect()->back()->with('success', 'Pengguna berhasil diupdate!');
    }


    public function deletePengguna($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Pengguna berhasil dihapus!');
    }
}
