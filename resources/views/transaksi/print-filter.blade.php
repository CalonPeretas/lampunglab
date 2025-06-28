<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Filter Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            position: relative;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            height: 60px;
            vertical-align: middle;
            margin-right: 10px;
        }

        .header h2 {
            display: inline-block;
            vertical-align: middle;
            font-size: 22px;
            margin: 0;
        }

        .header p {
            margin: 2px 0;
            font-size: 13px;
            color: #444;
        }

        .info {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th, td {
            border-bottom: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        .total {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
        }

        .watermark {
            position: fixed;
            top: 35%;
            left: 10%;
            font-size: 40px;
            color: rgba(200, 200, 200, 0.2);
            transform: rotate(-30deg);
            z-index: -1;
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="watermark">LAMPUNG DENTAL LABORATORY</div>

<div class="header">
    <img src="{{ asset('images/logo.png') }}" alt="Logo">
    <h2>Lampung Dental Laboratory</h2>
    <p>Jl. Contoh Alamat No. 123, Bandar Lampung</p>
    <p>Telp: (0721) 123456 | Email: info@lampungdental.com</p>
</div>

<div class="info">
    <p><strong>📄 Status:</strong> {{ request('status') ?? 'Semua' }}</p>
    <p><strong>👨‍⚕️ Dokter:</strong>
        @php
            $dokter = $dokters->where('id', request('dokter_id'))->first();
        @endphp
        {{ $dokter ? $dokter->nama : 'Semua Dokter' }}
    </p>
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Dokter</th>
            <th>Jenis Gigi</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Ongkir</th>
            <th>Total</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalHarga = 0;
            $totalOngkir = 0;
        @endphp
        @foreach ($transaksis as $i => $item)
            @php
                $totalHarga += $item->total_harga;
                $totalOngkir += $item->ongkir ?? 0;
            @endphp
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $item->dokter->nama ?? '-' }}</td>
                <td>{{ $item->jenisGigi->nama ?? '-' }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                <td>Rp{{ number_format($item->ongkir ?? 0, 0, ',', '.') }}</td>
                <td>Rp{{ number_format($item->total_harga + ($item->ongkir ?? 0), 0, ',', '.') }}</td>
                <td>{{ $item->status_pembayaran }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<table style="width: 100%; max-width: 400px; margin-left: auto; margin-top: 20px; border-collapse: collapse;">
    <tr>
        <td style="text-align: right; font-weight: bold; padding: 6px 8px;">Total Harga Transaksi:</td>
        <td style="text-align: right; padding: 6px 8px;">Rp{{ number_format($totalHarga, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td style="text-align: right; font-weight: bold; padding: 6px 8px;">Total Ongkir:</td>
        <td style="text-align: right; padding: 6px 8px;">Rp{{ number_format($totalOngkir, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td style="text-align: right; font-weight: bold; padding: 6px 8px; border-top: 2px solid #000;">Grand Total:</td>
        <td style="text-align: right; padding: 6px 8px; border-top: 2px solid #000;">Rp{{ number_format($totalHarga + $totalOngkir, 0, ',', '.') }}</td>
    </tr>
</table>

<script>
    window.print();
</script>

</body>
</html>
