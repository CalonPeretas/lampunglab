<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
    'dokter_id',
    'jenis_gigi_id',
    'jumlah',
    'ongkir',
    'total_harga',
    'tgl_selesai',
    'status_pembayaran',
];


    // 👨‍⚕️ Relasi ke tabel dokter
    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    // 🦷 Relasi ke tabel jenis gigi
    public function jenisGigi()
    {
        return $this->belongsTo(JenisGigi::class, 'jenis_gigi_id');
    }
}
