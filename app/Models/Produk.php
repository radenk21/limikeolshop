<?php

namespace App\Models;

use App\Models\GambarProduk;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produks';
    protected $fillable = [
        'id_sub_kategori',
        'id_brand',
        'name',
        'slug',
        'harga_beli',
        'harga_jual',
        'jumlah',
        'trending',
        'status'
    ];

    public function gambarProduk()
    {
        return $this->hasMany(GambarProduk::class, 'id_produk', 'id');
    }

    // public function kategori()
    // {
    //     return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    // }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'produk_suppliers' ,'id_produk', 'id_supplier');
    }
    
    public function produkSuppliers()
    {
        return $this->belongsToMany(Supplier::class, 'id_produk', 'id');
    }
    // public function jeniss()
    // {
    //     // return $this->belongsToMany(Supplier::class, 'produk_jenis' ,'id_produk', 'id_jenis');
    //     return $this->hasMany(ProdukJenis::class, 'id_produk', 'id');
    // }

    public function produkJenis()
    {
        return $this->hasMany(ProdukJenis::class, 'id_produk', 'id');
    }
    
    public function subKategori()
    {
        return $this->belongsTo(SubKategori::class, 'id_sub_kategori', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'id_brand', 'id');
    }
    
    public static function rules($id = null)
    {
        return [
            'name' => [
                'required',
                Rule::unique('produks', 'name')->ignore($id),
            ]
        ];
    }
}
