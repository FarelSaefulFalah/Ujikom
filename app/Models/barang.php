<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['kode_barang', 'nomor_seri', 'nama', 'kategori_id', 'jumlah', 'keterangan', 'gambar', 'status'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($barang) {
            $barang->kode_barang = self::generateUniqueKodeBarang();
            $barang->nomor_seri = self::generateUniqueNomorSeri();
        });

        static::updating(function ($barang) {
            if (!$barang->kode_barang) {
                $barang->kode_barang = self::generateUniqueKodeBarang();
            }
            if (!$barang->nomor_seri) {
                $barang->nomor_seri = self::generateUniqueNomorSeri();
            }
        });
    }

    private static function generateUniqueKodeBarang()
    {
        do {
            $kode = mt_rand(100000, 999999); // Angka random 6 digit
        } while (self::where('kode_barang', $kode)->exists());

        return $kode;
    }

    private static function generateUniqueNomorSeri()
    {
        do {
            $nomorSeri = 'SN-' . mt_rand(1000000, 9999999); // Nomor seri unik dengan format SN-XXXXXXX
        } while (self::where('nomor_seri', $nomorSeri)->exists());

        return $nomorSeri;
    }

    // Relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // Relasi ke peminjaman
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
