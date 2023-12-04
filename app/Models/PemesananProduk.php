<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananProduk extends Model
{
    use HasFactory;
    protected $table = 'pemesanan_produks';
    protected $fillable = [
        'id_produk',
        'id_supplier',
        'status',
        'jumlah_stok_sekarang',
        'jumlah_beli_stok',
        'total_harga_pesan',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier', 'id');
    }
}
