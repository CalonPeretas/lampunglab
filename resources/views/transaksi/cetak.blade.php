<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Rekap Transaksi</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 40px;
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #444;
            margin-bottom: 10px;
            padding-bottom: 8px;
        }

        .header img {
            height: 60px;
            margin-right: 15px;
        }

        .header-text {
            line-height: 1.3;
        }

        .header-text h2 {
            margin: 0;
            font-size: 18px;
            color: #0d47a1;
        }

        .header-text p {
            margin: 2px 0;
            font-size: 13px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #e3f2fd;
            color: #0d47a1;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .status {
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
        }

        .lunas {
            background-color: #c8e6c9;
            color: #2e7d32;
        }

        .belum {
            background-color: #ffcdd2;
            color: #c62828;
        }

        .summary-table {
            width: 40%;
            float: right;
            margin-top: 30px;
            border: 1px solid #ccc;
        }

        .summary-table th, .summary-table td {
            padding: 8px;
            text-align: left;
        }

        .summary-table th {
            background-color: #0d47a1;
            color: white;
        }

        .summary-table td {
            background-color: #f1f8e9;
            font-weight: bold;
        }

        @media print {
            body {
                margin: 0;
            }

            .header {
                border: none;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <div class="header">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
        <div class="header-text">
            <h2>Lampung Dental Laboratory</h2>
            <p>Dusun 3 Taman Sari, Jalan Family,Hajimena,Lampung Selatan</p>
            <p>Hp: (0812) 7189 6805 | Instagram: @dental_lab_lampung</p>
        </div>
    </div>

    {{-- JUDUL LAPORAN --}}
    <h3 style="margin-top: 10px; font-size: 16px; color: #0d47a1;">Laporan Pendapatan</h3>

    {{-- TABEL REKAP --}}
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tgl Masuk</th>
                <th>Dokter</th>
                <th>Jenis Gigi</th>
                <th>Qty</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php $totalPendapatan = 0; @endphp
            @foreach ($transaksis as $trx)
                @php $totalPendapatan += $trx->total_harga; @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $trx->created_at->format('d-m-Y') }}</td>
                    <td>{{ $trx->dokter->nama ?? '-' }}</td>
                    <td>{{ $trx->jenisGigi->nama ?? '-' }}</td>
                    <td>{{ $trx->jumlah }}</td>
                    <td>Rp{{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                    <td>
                        <span class="status {{ $trx->status_pembayaran === 'Lunas' ? 'lunas' : 'belum' }}">
                            {{ $trx->status_pembayaran }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- TABEL TOTAL PENDAPATAN --}}
    <table class="summary-table">
        <tr>
            <th>Total Pendapatan</th>
            <td>Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</td>
        </tr>
    </table>

    <script>
        window.print();
    </script>

</body>
</html>
