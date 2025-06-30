<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pembukuan</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 40px;
            color: #2c3e50;
            background-color: #f8f9fa;
        }

        h2 {
            text-align: center;
            text-transform: uppercase;
            color: #34495e;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 20px;
            font-size: 14px;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        th {
            background: linear-gradient(to right, #4facfe, #00f2fe);
            color: white;
            padding: 12px;
            border-bottom: 2px solid #dee2e6;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #dee2e6;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f1f3f5;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            color: white;
        }

        .badge-pemasukan {
            background-color: #28a745;
        }

        .badge-pengeluaran {
            background-color: #dc3545;
        }

        .summary {
            margin-top: 30px;
            text-align: right;
            font-size: 16px;
        }

        .summary table {
            width: 300px;
            float: right;
        }

        .summary td {
            padding: 8px 5px;
        }

        .summary tr:last-child td {
            font-weight: bold;
            font-size: 17px;
            border-top: 2px solid #ccc;
        }

        @media print {
            button {
                display: none;
            }
            body {
                background: white;
            }
        }

        .print-btn {
            display: block;
            margin: 30px auto;
            background: #0d6efd;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            font-size: 14px;
            cursor: pointer;
        }

        .print-btn:hover {
            background: #084298;
        }

        @media print {
            .print-btn-wrapper {
            display: none !important;
        }
}

    </style>
</head>
<body>

    <h2>Laporan Pembukuan Lampung Dental Laboratory</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalPemasukan = 0;
                $totalPengeluaran = 0;
            @endphp

            @forelse ($pembukuans as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <span class="badge {{ $item->jenis === 'Pemasukan' ? 'badge-pemasukan' : 'badge-pengeluaran' }}">
                            {{ $item->jenis }}
                        </span>
                    </td>
                    <td>{{ $item->keterangan }}</td>
                    <td>Rp{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                </tr>

                @php
                    if ($item->jenis === 'Pemasukan') {
                        $totalPemasukan += $item->jumlah;
                    } else {
                        $totalPengeluaran += $item->jumlah;
                    }
                @endphp
            @empty
                <tr>
                    <td colspan="5">Tidak ada data ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        <table>
            <tr>
                <td>Total Pemasukan</td>
                <td>: Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Pengeluaran</td>
                <td>: Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Keuntungan</td>
                <td>: Rp{{ number_format($totalPemasukan - $totalPengeluaran, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div class="print-btn-wrapper">
        <button class="print-btn" onclick="window.print()">🖨️ Cetak Laporan</button>
    </div>

</body>
</html>
