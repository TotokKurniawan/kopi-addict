<?php

namespace App\Http\Controllers;

use App\Models\Cart_meja;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today();

        // Pesanan hari ini
        $pesananHariIni = Transaksi::whereDate('created_at', $today)->count();

        // Meja tersedia dan tidak tersedia
        $mejaTersedia = Meja::where('status', operator: 'kosong')->count();
        $mejaTidakTersedia = Meja::where('status', operator: 'aktif')->count();

        // Pendapatan hari ini
        $pendapatanHariIni = Transaksi::whereDate('created_at', $today)->sum('total');

        // 5 pesanan terbaru
        $pesananTerbaru = Transaksi::with(['meja', 'user'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Progress bar meja
        $totalMeja = Meja::count();
        $mejaTerpakai = $totalMeja - $mejaTersedia;
        $progressMeja = $totalMeja > 0 ? ($mejaTerpakai / $totalMeja) * 100 : 0;

        return view('user.dashboardUser', compact(
            'pesananHariIni',
            'mejaTersedia',
            'mejaTidakTersedia',
            'pendapatanHariIni',
            'pesananTerbaru',
            'totalMeja',
            'mejaTerpakai',
            'progressMeja'
        ));
    }
    public function meja()
    {
        $mejas = Meja::all();
        return view('user.mejaUser', compact('mejas'));
    }
    public function menu()
    {
        $menus = Menu::orderBy('id', 'asc')->get();
        return view('user.menuUser', compact('menus'));
    }
    public function tambahmenu()
    {
        return view('user.form.tambah-menu');
    }
    public function tambahMeja()
    {
        // Ambil nomor meja terakhir
        $lastMeja = Meja::orderBy('nomor_meja', 'desc')->first();

        // Jika tidak ada meja sama sekali, mulai dari 1
        $nextNomor = $lastMeja ? $lastMeja->nomor_meja + 1 : 1;

        return view('user.form.tambah-meja', compact('nextNomor'));
    }
    public function transaksiPemesanan(Request $request)
    {
        $mejaId = $request->query('meja_id'); // ambil ID meja dari URL
        $menus = Menu::all(); // ambil semua menu
        $cart = Cart_meja::with('menu')->where('meja_id', $mejaId)->get(); // ambil menu di cart
        return view('user.transaksi-pemesanan', compact('mejaId', 'menus', 'cart')); // tambahkan $cart
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }
}
