<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function exportPdf(Request $request)
    {
        $start = $request->startDate;
        $end = $request->endDate;

        $query = Transaksi::with('detail.menu'); // pakai 'detail'

        if ($start && $end) {
            $query->whereBetween('created_at', [$start . ' 00:00:00', $end . ' 23:59:59']);
        }

        $transaksis = $query->get();

        // Hitung total pendapatan
        $totalPendapatan = $transaksis->sum(function ($transaksi) {
            return $transaksi->detail->sum('subtotal');
        });

        $pdf = Pdf::loadView('admin.modal.pdf', compact('transaksis', 'start', 'end', 'totalPendapatan'));
        return $pdf->download('laporan_transaksi.pdf');
    }
}
