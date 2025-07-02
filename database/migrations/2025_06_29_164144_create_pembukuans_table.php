<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembukuansTable extends Migration
{
    public function up(): void
    {
        Schema::create('pembukuans', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis', ['Pemasukan', 'Pengeluaran']);
            $table->string('keterangan');
            $table->decimal('jumlah', 15, 2);
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembukuans');
    }
}
