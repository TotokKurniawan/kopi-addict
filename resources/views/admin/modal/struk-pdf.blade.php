<!DOCTYPE html>
<html>

<head>
    <title>Struk Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 10px;
            border: 1px dashed #000;
        }

        h2,
        h3 {
            text-align: center;
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0;
        }

        td {
            padding: 3px 0;
        }

        .label {
            text-align: left;
        }

        .value {
            text-align: right;
        }

        .items td {
            border-bottom: 1px dotted #ddd;
        }

        .summary td {
            font-weight: bold;
        }

        /* garis pemisah */
        .separator {
            border-bottom: 1px dashed #000;
            height: 1px;
        }

        .footer {
            text-align: center;
            margin-top: 15px;
            border-top: 1px dashed #000;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Coffee Addict</h2>
        <h3>Struk Transaksi</h3>

        <!-- Info Transaksi -->
        <table>
            <tr>
                <td class="label">No. Pesanan</td>
                <td class="value">#{{ $transaksi->id }}</td>
            </tr>
            <tr>
                <td colspan="2" class="separator"></td>
            </tr>
            <tr>
                <td class="label">Tanggal</td>
                <td class="value">{{ $transaksi->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            <tr>
                <td class="label">Kasir</td>
                <td class="value">{{ $transaksi->user->nama }}</td>
            </tr>
            <tr>
                <td colspan="2" class="separator"></td>
            </tr>
            <tr>
                <td class="label">Nama Reservasi</td>
                <td class="value">{{ $transaksi->meja->nama_reservasi ?? 'N/A' }}</td>
            </tr>
        </table>

        <!-- Batas antara reservasi dan item -->
        <div class="separator"></div>

        <!-- Daftar Item -->
        <table class="items">
            @foreach ($transaksi->detail as $detail)
                <tr>
                    <td class="label">{{ $detail->menu->nama }} x{{ $detail->qty }}</td>
                    <td class="value">Rp {{ number_format($detail->subtotal) }}</td>
                </tr>
            @endforeach
        </table>

        <!-- Batas antara item dan total -->
        <div class="separator"></div>

        <!-- Ringkasan -->
        <table class="summary">
            <tr>
                <td class="label">Total</td>
                <td class="value">Rp {{ number_format($transaksi->total) }}</td>
            </tr>
            <tr>
                <td class="label">Bayar</td>
                <td class="value">Rp {{ number_format($transaksi->bayar ?? 0) }}</td>
            </tr>
            <tr>
                <td class="label">Kembalian</td>
                <td class="value">Rp {{ number_format($transaksi->kembalian ?? 0) }}</td>
            </tr>
            <tr>
                <td class="label">Metode</td>
                <td class="value">{{ ucfirst($transaksi->pembayaran) }}</td>
            </tr>
        </table>

        <!-- Footer -->
        <div class="footer">
            <p>Terima Kasih atas kunjungan Anda!</p>
            <p>Semoga hari Anda menyenangkan ☕</p>
        </div>
    </div>
</body>

</html>
