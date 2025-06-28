<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Pekerjaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            color: #333;
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }

        .header img {
            height: 80px;
            margin-right: 20px;
        }

        .header-text {
            flex-grow: 1;
            text-align: left;
            line-height: 1.4;
        }

        .header-text h2 {
            margin: 0;
            font-size: 20px;
        }

        .header-text p {
            margin: 2px 0;
            font-size: 14px;
        }

        .info {
            margin-bottom: 30px;
            line-height: 1.8;
        }

        .info label {
            display: inline-block;
            width: 160px;
            font-weight: bold;
        }

        .detail table {
            width: 100%;
            border-collapse: collapse;
        }

        .detail th, .detail td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 10px;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 0.9rem;
            color: #777;
        }

        @media print {
            body {
                margin: 0;
            }

            body::before {
                content: "LAMPUNG DENTAL LABORATORY";
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%) rotate(-30deg);
                font-size: 45px;
                color: rgba(0, 0, 0, 0.06);
                font-weight: bold;
                white-space: nowrap;
                z-index: 0;
                pointer-events: none;
            }

            body * {
                position: relative;
                z-index: 1;
            }
        }
    </style>
</head>
<body onload="window.print()">

    {{-- HEADER --}}
    <div class="header">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Lab Gigi">
        <div class="header-text">
            <h2>Lampung Dental Laboratory</h2>
            <p>Jl. Contoh Alamat No. 123, Bandar Lampung</p>
            <p>Telp: (0721) 123456 | Email: info@lampungdental.com</p>
        </div>
    </div>

    {{-- INFORMASI --}}
    <div class="info">
        <div><label>Nama Dokter</label>: {{ $transaksi->dokter->nama ?? '-' }}</div>
        <div><label>Tanggal Masuk</label>: {{ $transaksi->created_at->format('d-m-Y') }}</div>
        <div><label>Tanggal Selesai</label>: {{ $transaksi->tgl_selesai ? \Carbon\Carbon::parse($transaksi->tgl_selesai)->format('d-m-Y') : '-' }}</div>
        <div><label>Status Pembayaran</label>: {{ $transaksi->status_pembayaran }}</div>
    </div>

    {{-- DETAIL --}}
    <div class="detail">
        <table>
            <thead>
                <tr>
                    <th>Jenis Gigi</th>
                    <th>Jumlah</th>
                    <th>Harga per Unit</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $transaksi->jenisGigi->nama ?? '-' }}</td>
                    <td>{{ $transaksi->jumlah }}</td>
                    <td>Rp{{ number_format($transaksi->jenisGigi->harga ?? 0, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="total">Total Harga Transaksi: Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}</div>
        <div class="total">Ongkir: Rp{{ number_format($transaksi->ongkir ?? 0, 0, ',', '.') }}</div>
        <div class="total">Grand Total: Rp{{ number_format($transaksi->total_harga + ($transaksi->ongkir ?? 0), 0, ',', '.') }}</div>
    </div>

    {{-- FOOTER --}}
    <div class="footer">
        Terima kasih atas kepercayaan Anda.
    </div>

</body>
</html>
