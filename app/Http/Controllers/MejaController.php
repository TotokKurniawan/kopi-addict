<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nomor_meja' => 'required|integer|unique:mejas,nomor_meja',
            'status' => 'required|in:kosong,aktif',
        ]);

        Meja::create([
            'nomor_meja' => $request->nomor_meja,
            'status' => $request->status,
        ]);

        return redirect()->route('mejaUser')->with('success', 'Meja baru berhasil ditambahkan!');
    }

    public function reservasi(Request $request)
    {
        $request->validate([
            'meja_id' => 'required|exists:mejas,id',
        ]);

        $meja = Meja::find($request->meja_id);
        $meja->status = 'aktif';
        $meja->save();

        return redirect()->route('mejaUser')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function storeadmin(Request $request)
    {
        $request->validate([
            'nomor_meja' => 'required|integer|unique:mejas,nomor_meja',
            'status' => 'required|in:kosong,aktif',
        ]);

        Meja::create([
            'nomor_meja' => $request->nomor_meja,
            'status' => $request->status,
        ]);

        return redirect()->route('meja')->with('success', 'Meja baru berhasil ditambahkan!');
    }

    public function reservasiadmin(Request $request)
    {
        $request->validate([
            'meja_id' => 'required|exists:mejas,id',
        ]);

        // update status meja
        $meja = Meja::findOrFail($request->meja_id);
        $meja->update([
            'status' => 'aktif'
        ]);

        return redirect()->route('meja')->with('success', 'Meja berhasil digunakan!');
    }
}
