<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $table = 'umkm';
    protected $casts = [
        'portfolio_produk' => 'array',
    ];

    protected $fillable = [
        'pengguna_id', 
        'nama_usaha', 
        'no_whatsapp', 
        'npwp', 
        'alamat_usaha', 
        'status_tempat', 
        'luas_lahan', 
        'kbli', 
        'jumlah_karyawan', 
        'kategori', 
        'modal_usaha', 
        'omzet_tahunan',
        'limit_pinjaman', 
        'saldo_pinjaman',
        'kapasitas_produksi', 
        'sistem_penjualan', 
        'deskripsi', 
        'status',
        'nama_bank',
        'nomor_rekening',
        'portfolio_produk',
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriUmkm::class, 'kategori_id');
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id');
    }

    public function legalitas()
    {
        return $this->hasOne(LegalitasUmkm::class, 'umkm_id');
    }

    public function PembiayaanModal()
    {
        return $this->hasMany(PembiayaanModal::class, 'umkm_id');
    }

    public function pendaftaranEvent()
    {
        return $this->hasMany(PendaftaranEvent::class, 'umkm_id');
    }
}
