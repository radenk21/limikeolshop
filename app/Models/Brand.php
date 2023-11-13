<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $fillable = [
        'name',
        'slug',
        'status',
    ];
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id', 'id_produk');
    }
    public function produks()
    {
        return $this->belongsTo(Produk::class, 'id', 'id_produk');
    }
}
