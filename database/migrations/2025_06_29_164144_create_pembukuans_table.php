Schema::create('pembukuans', function (Blueprint $table) {
    $table->id();
    $table->enum('jenis', ['Pemasukan', 'Pengeluaran']);
    $table->string('keterangan');
    $table->decimal('jumlah', 15, 2);
    $table->date('tanggal');
    $table->timestamps();
});
