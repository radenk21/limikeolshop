<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $fillable =[
        'name',
        'email',
        'no_telp',
        'alamat'
    ];
    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'produk_suppliers', 'id_supplier', 'id_produk');
    }

    public function pemesananProduk()
    {
        return $this->belongsToMany(PemesananProduk::class, 'id_supplier', 'id');
    }
}
