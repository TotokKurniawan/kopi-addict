<?php

namespace App\Http\Controllers;

use App\Models\Struk;
use App\Models\Toko;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function simpanToko(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|string',
            'logo_toko' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'alamat_toko' => 'required|string',
            'pajak' => 'required|integer|min:0',
        ]);

        $toko = Toko::first() ?? new Toko();
        $toko->nama_toko = $request->nama_toko;
        $toko->alamat_toko = $request->alamat_toko;
        $toko->pajak = $request->pajak;

        if ($request->hasFile('logo_toko')) {
            $file = $request->file('logo_toko');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/toko'), $filename);
            $toko->logo_toko = $filename;
        }

        $toko->save();

        return redirect()->back()->with('success', 'Pengaturan Toko berhasil disimpan!');
    }

    public function simpanStruk(Request $request)
    {
        $request->validate([
            'header_struk' => 'nullable|string',
            'footer_struk' => 'nullable|string',
        ]);

        $struk = Struk::first() ?? new Struk();
        $struk->header_struk = $request->header_struk;
        $struk->footer_struk = $request->footer_struk;
        $struk->save();

        return redirect()->back()->with('success', 'Pengaturan Struk berhasil disimpan!');
    }
}
