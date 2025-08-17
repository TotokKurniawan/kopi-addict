<!DOCTYPE html>
<html>

<head>
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h2,
        h4 {
            margin: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .info {
            margin-bottom: 15px;
        }

        .info p {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #fc9800;
            color: white;
        }

        tfoot td {
            font-weight: bold;
        }

        tfoot tr td:last-child {
            text-align: right;
        }
    </style>
</head>

<body>
    <h3>Laporan Transaksi - COFFE ADDICT</h3>
    @if ($start && $end)
        <p>Periode: {{ $start }} s/d {{ $end }}</p>
    @endif
    <p>Total Pendapatan: Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Menu</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
                $grandTotal = 0;
            @endphp
            @foreach ($transaksis as $transaksi)
                @foreach ($transaksi->detail as $detail)
                    @php $grandTotal += $detail->subtotal; @endphp
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $transaksi->created_at->format('Y-m-d') }}</td>
                        <td>{{ $detail->menu->nama }}</td>
                        <td>{{ ucfirst($detail->menu->kategori) }}</td>
                        <td>{{ $detail->qty }}</td>
                        <td>Rp {{ number_format($detail->menu->harga, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" style="text-align:right;">Grand Total</td>
                <td>Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

</body>

</html>
