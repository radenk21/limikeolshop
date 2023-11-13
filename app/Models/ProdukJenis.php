<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukJenis extends Model
{
    use HasFactory;
    protected $table = 'produk_jenis';
    protected $fillable = [
        'id_produk',
        'id_jenis',
        'jumlah'
    ];
    // public function produk()
    // {
    //     return $this->belongsTo(Produk::class, 'id_produk', 'id');
    // }
    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'id_jenis', 'id');
    }
}
