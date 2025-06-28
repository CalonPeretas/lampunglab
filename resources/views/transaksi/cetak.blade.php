<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cetak Rekap Transaksi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Rekap Transaksi</h2>
    <p>Periode:
        {{ request('tanggal_awal') ? \Carbon\Carbon::parse(request('tanggal_awal'))->format('d-m-Y') : '-' }}
        s/d
        {{ request('tanggal_akhir') ? \Carbon\Carbon::parse(request('tanggal_akhir'))->format('d-m-Y') : '-' }}
    </p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Tgl Masuk</th>
                <th>Dokter</th>
                <th>Jenis Gigi</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksis as $trx)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $trx->created_at->format('d-m-Y') }}</td>
                    <td>{{ $trx->dokter->nama ?? '-' }}</td>
                    <td>{{ $trx->jenisGigi->nama ?? '-' }}</td>
                    <td>{{ $trx->jumlah }}</td>
                    <td>Rp{{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $trx->status_pembayaran }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    

    <script>
        window.print();
    </script>
</body>
</html>
