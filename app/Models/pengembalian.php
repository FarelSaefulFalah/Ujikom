<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengembalian extends Model
{
    use HasFactory;

    protected $fillable = ['peminjaman_id', 'tanggal_pengembalian', 'denda_akhir', 'keterangan'];

    // Relasi ke Peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    // Relasi ke Pembayaran
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    // Fungsi untuk melakukan pembayaran denda
    public function bayarDenda($userId, $metodePembayaran)
    {
        // Cek apakah sudah dibayar
        if ($this->pembayaran) {
            return false; // Denda sudah dibayar
        }

        // Cek apakah ada denda yang harus dibayar
        if ($this->denda_akhir <= 0) {
            return false;
        }

        // Buat transaksi pembayaran
        Pembayaran::create([
            'pengembalian_id' => $this->id,
            'user_id' => $userId,
            'jumlah_denda' => $this->denda_akhir,
            'metode_pembayaran' => $metodePembayaran,
            'status_pembayaran' => 'lunas',
        ]);

        return true;
    }
}
