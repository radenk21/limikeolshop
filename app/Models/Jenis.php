<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;
    protected $table = 'jeniss';
    protected $fillable = [
        'name',
        'code',
        'status',
    ];
    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'produk_jenis', 'id_jenis', 'id_produk');
    }
}
