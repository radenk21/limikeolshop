<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukSupplier extends Model
{
    use HasFactory;
    protected $table = 'produk_suppliers';
    protected $fillable = [
        'id_supplier',
        'id_produk',
    ];
}
