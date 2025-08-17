<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function transaksiPemesanan(Request $request)
    {
        $mejaId = $request->query('meja_id');
        $menus = Menu::all();
        return view('admin.transaksi-pemesanan', compact('menus', 'mejaId'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'meja_id' => 'required|exists:mejas,id',
            'menu_json' => 'required',
            'pembayaran' => 'required|in:cash,qris'
        ]);

        $menuList = json_decode($request->menu_json, true);
        $total = $request->total;
        $bayar = $request->bayar;
        $kembalian = $request->kembalian;
        $status = $request->pembayaran === 'cash' ? 'lunas' : 'belum lunas';

        if ($request->pembayaran === 'qris') {
            $bayar = null;
            $kembalian = null;
        }

        // Simpan transaksi
        $transaksi = Transaksi::create([
            'user_id' => auth()->id(),
            'meja_id' => $request->meja_id,
            'status' => $status,
            'pembayaran' => $request->pembayaran,
            'bayar' => $bayar,
            'kembalian' => $kembalian,
            'total' => $total
        ]);

        // Simpan detail transaksi
        foreach ($menuList as $item) {
            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'menu_id' => $item['menu_id'],
                'qty' => $item['qty'],
                'subtotal' => $item['harga'] * $item['qty']
            ]);
        }

        // Update status meja
        Meja::where('id', $request->meja_id)->update(['status' => 'sedangdigunakan']);

        // Kembalikan JSON untuk frontend
        return response()->json([
            'success' => true,
            'transaksi_id' => $transaksi->id,
            'metode' => $request->pembayaran
        ]);
    }
    public function struk($id)
    {
        $transaksi = Transaksi::with(['detail.menu', 'user', 'meja'])->findOrFail($id);

        if ($transaksi->pembayaran === 'cash') {
            $pdf = PDF::loadView('admin.modal.struk-pdf', compact('transaksi'));
            return $pdf->download('struk_' . $transaksi->id . '.pdf');
        }

        // Jika QRIS → redirect ke datapesanan
        return redirect()->route('datapesanan')
            ->with('success', 'Transaksi QRIS berhasil disimpan tanpa cetak struk.');
    }
    public function storeuser(Request $request)
    {
        $request->validate([
            'meja_id' => 'required|exists:mejas,id',
            'menu_json' => 'required',
            'pembayaran' => 'required|in:cash,qris'
        ]);

        $menuList = json_decode($request->menu_json, true);
        $total = $request->total;
        $bayar = $request->bayar;
        $kembalian = $request->kembalian;
        $status = $request->pembayaran === 'cash' ? 'lunas' : 'belum lunas';

        if ($request->pembayaran === 'qris') {
            $bayar = null;
            $kembalian = null;
        }

        // Simpan transaksi
        $transaksi = Transaksi::create([
            'user_id' => auth()->id(),
            'meja_id' => $request->meja_id,
            'status' => $status,
            'pembayaran' => $request->pembayaran,
            'bayar' => $bayar,
            'kembalian' => $kembalian,
            'total' => $total
        ]);

        // Simpan detail transaksi
        foreach ($menuList as $item) {
            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'menu_id' => $item['menu_id'],
                'qty' => $item['qty'],
                'subtotal' => $item['harga'] * $item['qty']
            ]);
        }

        // Update status meja
        Meja::where('id', $request->meja_id)->update(['status' => 'sedangdigunakan']);

        // Kembalikan JSON untuk frontend
        return response()->json([
            'success' => true,
            'transaksi_id' => $transaksi->id,
            'metode' => $request->pembayaran
        ]);
    }
    public function strukuser($id)
    {
        $transaksi = Transaksi::with(['detail.menu', 'user', 'meja'])->findOrFail($id);

        if ($transaksi->pembayaran === 'cash') {
            $pdf = PDF::loadView('admin.modal.struk-pdf', compact('transaksi'));
            return $pdf->download('struk_' . $transaksi->id . '.pdf');
        }

        // Jika QRIS → redirect ke datapesanan
        return redirect()->route('datapesananuser')
            ->with('success', 'Transaksi QRIS berhasil disimpan tanpa cetak struk.');
    }
}
