<?php

namespace App\Http\Controllers;

use App\Models\Cart_meja;
use App\Models\DetailTransaksi;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\Struk;
use App\Models\Toko;
use App\Models\Transaksi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboardadmin()
    {
        $today = Carbon::today();

        // Pesanan hari ini
        $pesananHariIni = Transaksi::whereDate('created_at', $today)->count();

        // Meja
        $mejaTersedia = Meja::where('status', operator: 'kosong')->count();
        $mejaTidakTersedia = Meja::where('status', '!=', 'aktif')->count();

        // Pendapatan hari ini
        $pendapatanHariIni = Transaksi::whereDate('created_at', $today)->sum('total');

        // 5 Pesanan Terbaru
        $pesananTerbaru = Transaksi::with('meja', 'user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Grafik pertumbuhan pendapatan per hari bulan ini
        $startMonth = Carbon::now()->startOfMonth();
        $endMonth = Carbon::now()->endOfMonth();

        $pendapatanPerHari = Transaksi::select(
            DB::raw('DAY(created_at) as day'),
            DB::raw('SUM(total) as total')
        )
            ->whereBetween('created_at', [$startMonth, $endMonth])
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('total', 'day')
            ->toArray();

        $daysInMonth = Carbon::now()->daysInMonth;
        $pendapatanGrafik = [];
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $pendapatanGrafik[$i] = $pendapatanPerHari[$i] ?? 0;
        }

        // Data pengguna (top 5 terbaru)
        $usersTop = User::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'pesananHariIni',
            'mejaTersedia',
            'mejaTidakTersedia',
            'pendapatanHariIni',
            'pesananTerbaru',
            'pendapatanGrafik',
            'usersTop'
        ));
    }

    public function menu()
    {
        $menus = Menu::orderBy('id', 'asc')->get();
        return view('admin.menu', compact('menus'));
    }
    public function meja()
    {
        $mejas = Meja::all();
        return view('admin.meja', compact('mejas'));
    }
    public function transaksi(Request $request)
    {
        $start = $request->startDate;
        $end = $request->endDate;

        $query = Transaksi::with(['detail.menu']);

        if ($start && $end) {
            $query->whereBetween('created_at', [$start . ' 00:00:00', $end . ' 23:59:59']);
        }

        $transaksis = $query->get();

        return view('admin.transaksi', compact('transaksis', 'start', 'end'));
    }
    public function transaksiPemesanan(Request $request)
    {
        $mejaId = $request->query('meja_id'); // ambil ID meja dari URL
        $menus = Menu::all(); // ambil semua menu
        $cart = Cart_meja::with('menu')->where('meja_id', $mejaId)->get(); // ambil menu di cart
        return view('admin.transaksi-pemesanan', compact('mejaId', 'menus', 'cart')); // tambahkan $cart
    }
    public function pengguna()
    { {
            $users = User::all(); // ambil semua pengguna
            return view('admin.pengguna', compact('users'));
        }
    }
    public function pengaturan()
    {
        $toko = Toko::first();
        $struk = Struk::first();
        return view('admin.pengaturan', compact('toko', 'struk'));
    }

    public function laporan()
    {
        $year = request('tahun');
        $month = request('bulan');

        // Pendapatan per bulan (hanya jika tahun dipilih)
        $pendapatanData = [];
        if ($year) {
            for ($m = 1; $m <= 12; $m++) {
                $total = Transaksi::whereYear('created_at', $year)
                    ->whereMonth('created_at', $m)
                    ->sum('total');
                $pendapatanData[] = $total;
            }
        }

        // Top 5 Menu Terlaris & Kurang Laris
        $menuLabels = collect();
        $menuData = collect();
        $menuKurangLabels = collect();
        $menuKurangData = collect();

        if ($year && $month) {
            // 5 Terlaris
            $menuTerlaris = DetailTransaksi::with('menu')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->selectRaw('menu_id, SUM(qty) as total_qty')
                ->groupBy('menu_id')
                ->orderByDesc('total_qty')
                ->limit(5)
                ->get();

            $menuLabels = $menuTerlaris->pluck('menu.nama')->map(fn($n) => $n ?? 'Unknown');
            $menuData = $menuTerlaris->pluck('total_qty')->map(fn($n) => (int)$n);

            // 5 Kurang Laris
            $menuKurangLaris = DetailTransaksi::with('menu')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->selectRaw('menu_id, SUM(qty) as total_qty')
                ->groupBy('menu_id')
                ->orderBy('total_qty', 'asc') // urut dari yang paling sedikit
                ->limit(5)
                ->get();

            $menuKurangLabels = $menuKurangLaris->pluck('menu.nama')->map(fn($n) => $n ?? 'Unknown');
            $menuKurangData = $menuKurangLaris->pluck('total_qty')->map(fn($n) => (int)$n);
        }

        return view('admin.laporan', compact(
            'pendapatanData',
            'menuLabels',
            'menuData',
            'menuKurangLabels',
            'menuKurangData',
            'year',
            'month'
        ));
    }



    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }
    public function tambahMenu()
    {
        return view(
            'admin.form.tambah-menu'
        );
    }

    public function tambahMeja()
    {
        // Ambil nomor meja terakhir
        $lastMeja = Meja::orderBy('nomor_meja', 'desc')->first();

        // Jika tidak ada meja sama sekali, mulai dari 1
        $nextNomor = $lastMeja ? $lastMeja->nomor_meja + 1 : 1;

        return view('admin.form.tambah-meja', compact('nextNomor'));
    }
    public function tambahPengguna()
    {
        return view(
            'admin.form.tambah-pengguna'
        );
    }
    // Cetak Struk PDF
    public function struk($id)
    {
        $transaksi = Transaksi::with(['detail.menu', 'user', 'meja'])->findOrFail($id);
        $pdf = PDF::loadView('admin.modal.struk-pdf', compact('transaksi'));
        return $pdf->download('struk_' . $transaksi->id . '.pdf');
    }
}
