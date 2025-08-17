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
            'status' => 'required|in:tersedia,sudahdipesan,sedangdigunakan',
        ]);

        Meja::create([
            'nomor_meja' => $request->nomor_meja,
            'status' => $request->status,
            'nama_reservasi' => null,
        ]);

        return redirect()->route('mejaUser')->with('success', 'Meja baru berhasil ditambahkan!');
    }

    public function reservasi(Request $request)
    {
        $request->validate([
            'meja_id' => 'required|exists:mejas,id',
            'nama_reservasi' => 'required|string|max:255'
        ]);

        $meja = Meja::find($request->meja_id);
        $meja->nama_reservasi = $request->nama_reservasi;
        $meja->status = 'sudahdipesan';
        $meja->save();

        return redirect()->route('mejaUser')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function selesai(Request $request)
    {
        $request->validate([
            'meja_id' => 'required|exists:mejas,id'
        ]);

        $meja = Meja::find($request->meja_id);
        $meja->nama_reservasi = null;
        $meja->status = 'tersedia';
        $meja->save();

        return redirect()->route('mejaUser')->with('success', 'Menu berhasil ditambahkan!');
    }
    public function storeadmin(Request $request)
    {
        $request->validate([
            'nomor_meja' => 'required|integer|unique:mejas,nomor_meja',
            'status' => 'required|in:tersedia,sudahdipesan,sedangdigunakan',
        ]);

        Meja::create([
            'nomor_meja' => $request->nomor_meja,
            'status' => $request->status,
            'nama_reservasi' => null,
        ]);

        return redirect()->route('meja')->with('success', 'Meja baru berhasil ditambahkan!');
    }

    public function reservasiadmin(Request $request)
    {
        $request->validate([
            'meja_id' => 'required|exists:mejas,id',
            'nama_reservasi' => 'required|string|max:255'
        ]);

        $meja = Meja::find($request->meja_id);
        $meja->nama_reservasi = $request->nama_reservasi;
        $meja->status = 'sudahdipesan';
        $meja->save();

        return redirect()->route('meja')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function selesaiadmin(Request $request)
    {
        $request->validate([
            'meja_id' => 'required|exists:mejas,id'
        ]);

        $meja = Meja::find($request->meja_id);
        $meja->nama_reservasi = null;
        $meja->status = 'tersedia';
        $meja->save();

        return redirect()->route('meja')->with('success', 'Menu berhasil ditambahkan!');
    }
}
