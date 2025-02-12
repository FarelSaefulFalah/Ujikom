<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['kode_barang', 'nama', 'kategori_id', 'jumlah', 'keterangan', 'gambar'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($barang) {
            $barang->kode_barang = self::generateUniqueKodeBarang();
        });
    }

    private static function generateUniqueKodeBarang()
    {
        do {
            $kode = mt_rand(100000, 999999); // Angka random 6 digit
        } while (self::where('kode_barang', $kode)->exists());

        return $kode;
    }

    // Relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
