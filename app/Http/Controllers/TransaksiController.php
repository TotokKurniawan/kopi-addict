<?php

namespace App\Http\Controllers;

use App\Models\Cart_meja;
use App\Models\DetailTransaksi;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // <- ini yang benar

class TransaksiController extends Controller
{

    public function addToCart(Request $request)
    {
        $cart = Cart_meja::where('meja_id', $request->meja_id)
            ->where('menu_id', $request->menu_id)
            ->first();

        if ($cart) {
            // jika sudah ada, tambah qty
            $cart->qty += 1;
            $cart->harga = $request->harga; // update harga sesuai menu
            $cart->save();
        } else {
            // jika belum ada, buat baru
            $cart = Cart_meja::create([
                'meja_id' => $request->meja_id,
                'menu_id' => $request->menu_id,
                'qty' => 1,
                'harga' => $request->harga
            ]);
        }

        return response()->json($cart);
    }
    public function bayarTerpilih(Request $request)
    {
        $request->validate([
            'meja_id' => 'required|exists:mejas,id',
            'metode' => 'required|in:cash,qris',
            'menu' => 'required|array|min:1',
            'menu.*.menu_id' => 'required|exists:menus,id',
            'menu.*.qty' => 'required|integer|min:1',
            'menu.*.harga' => 'required|integer|min:0',
            'bayar' => 'nullable|integer|min:0',
        ]);

        $userId = Auth::id();
        $mejaId = $request->meja_id;
        $metode = $request->metode;
        $menuItems = $request->menu;

        $total = collect($menuItems)->sum(fn($item) => $item['harga'] * $item['qty']);
        $bayar = ($metode === 'cash') ? ($request->bayar ?? 0) : $total;
        $kembalian = ($metode === 'cash') ? max($bayar - $total, 0) : 0;

        if ($metode === 'cash' && $bayar < $total) {
            return response()->json(['success' => false, 'message' => 'Jumlah bayar kurang!'], 400);
        }

        DB::beginTransaction();
        try {
            $transaksi = Transaksi::create([
                'user_id' => $userId,
                'meja_id' => $mejaId,
                'status' => 'lunas',
                'pembayaran' => $metode,
                'bayar' => $bayar,
                'kembalian' => $kembalian,
                'total' => $total
            ]);

            foreach ($menuItems as $item) {
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'menu_id' => $item['menu_id'],
                    'qty' => $item['qty'],
                    'subtotal' => $item['harga'] * $item['qty']
                ]);

                // hapus menu dari cart
                Cart_meja::where('meja_id', $mejaId)->where('menu_id', $item['menu_id'])->delete();
            }

            // **Cek apakah cart meja sudah kosong**
            $sisaMenu = Cart_meja::where('meja_id', $mejaId)->count();
            if ($sisaMenu == 0) {
                $meja = Meja::find($mejaId);
                $meja->status = 'kosong'; // update status meja menjadi kosong
                $meja->save();
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil!',
                'transaksi_id' => $transaksi->id
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
    public function strukuser($id)
    {
        $transaksi = Transaksi::with(['detail.menu', 'user', 'meja'])->findOrFail($id);
        $pdf = PDF::loadView('admin.modal.struk-pdf', compact('transaksi'));
        $filename = 'struk_' . $transaksi->id . '.pdf';
        $path = storage_path('app/public/' . $filename);
        $pdf->save($path);

        return response()->json(['success' => true, 'url' => asset('storage/' . $filename)]);
    }
}
