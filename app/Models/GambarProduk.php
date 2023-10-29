<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarProduk extends Model
{
    use HasFactory;
    protected $table = 'gambar_produks';
    protected $fillable = [
        'id_produk',
        'image'
    ];
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id', 'id_produk');
    }
}
