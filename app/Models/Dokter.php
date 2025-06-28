<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    // Field yang boleh diisi secara mass-assignment
    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'nama_klinik'
    ];
}
