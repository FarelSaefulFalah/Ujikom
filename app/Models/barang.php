<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory,HasSlug;

    protected $fillable = [
    'name', 'slug', 'keterangan', 'jumlah', 'satuan', 'gambar', 'kategori_id', 'pemasok_id'
    ];


    // Relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // Relasi ke pemasok
    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class);
    }

    public function cart(){
        return $this->hasMany(cart::class,'barang_id');
    }

}

