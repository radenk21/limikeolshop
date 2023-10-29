<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKategori extends Model
{
    use HasFactory;
    protected $table = 'sub_kategoris';
    protected $fillable = [
        'id_kategori',
        'name',
        'description',
        'slug',
        'status',
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_sub_kategori', 'id');
    }
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }
}
