<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    use HasFactory;

    protected $fillable = ['pengembalian_id', 'user_id', 'jumlah_denda', 'metode_pembayaran', 'status_pembayaran'];

    // Relasi ke Pengembalian
    public function pengembalian()
    {
        return $this->belongsTo(Pengembalian::class);
    }

    // Relasi ke User (yang membayar)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
