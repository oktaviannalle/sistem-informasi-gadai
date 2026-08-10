<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_gadais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_gadai_id')->constrained('barang_gadais')->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->date('tanggal_gadai');
            $table->decimal('jumlah_pinjaman', 15, 2);
            $table->decimal('bunga_persen', 5, 2)->default(5.00);
            $table->date('tanggal_jatuh_tempo');
            $table->enum('status', ['aktif', 'lunas', 'lelang'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_gadais');
    }
};
