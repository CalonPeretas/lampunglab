<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembukuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis',
        'keterangan',
        'jumlah',
        'tanggal',
    ];
}
