<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembiayaan_modal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('umkm_id')->constrained('umkm')->onDelete('cascade');
            $table->foreignId('mitra_id')->nullable()->constrained('pengguna');
            $table->bigInteger('jumlah_pinjaman');
            $table->date('tanggal_pinjam');
            $table->date('tenggat_waktu');
            $table->string('status_pelunasan');
            $table->string('nama_bank')->nullable();
            $table->string('nomor_rekening')->nullable();
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembiayaan_modal');
    }
};
