<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Peminjaman extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'user_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status_peminjaman',
        'denda'
    ];

    protected $dates = ['tanggal_pinjam', 'tanggal_kembali'];

    // Relasi ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Pengembalian (Jika ada)
    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class);
    }

    // Cek dan Update Status Keterlambatan
    public function cekKeterlambatan()
{
    $now = now();

    if ($this->status_peminjaman === 'approved' || $this->status_peminjaman === 'terlambat') {
        if ($now->greaterThan($this->tanggal_kembali)) {
            $hariTerlambat = $now->diffInDays($this->tanggal_kembali);
            $this->denda = $hariTerlambat * 3000;
            $this->status_peminjaman = 'terlambat';
        } else {
            $this->denda = 0;
            $this->status_peminjaman = 'approved';
        }
        $this->save();
    }
}



    // Proses Pengembalian Barang
    public function kembalikanBarang()
    {
        if ($this->status_peminjaman === 'returned') {
            return false; // Sudah dikembalikan sebelumnya
        }

        $tanggalPengembalian = now();
        $denda = $this->hitungDenda($tanggalPengembalian);

        // Update stok barang setelah dikembalikan
        $this->barang->increment('jumlah');

        // Simpan data pengembalian
        $this->pengembalian()->create([
            'tanggal_pengembalian' => $tanggalPengembalian,
            'denda_akhir' => $denda,
            'keterangan' => 'Barang dikembalikan',
        ]);

        // Update status peminjaman
        $this->update([
            'status_peminjaman' => 'returned',
            'denda' => $denda
        ]);

        return true;
    }

    // Hitung Denda Jika Terlambat
    public function hitungDenda($tanggalPengembalian = null)
    {
        $tanggalPengembalian = $tanggalPengembalian ?? now();

        if ($this->tanggal_kembali && $tanggalPengembalian->greaterThan($this->tanggal_kembali)) {
            $hariTerlambat = $tanggalPengembalian->diffInDays($this->tanggal_kembali);
            return $hariTerlambat * 3000; // Rp 5.000 per hari keterlambatan
        }

        return 0;
    }
}
