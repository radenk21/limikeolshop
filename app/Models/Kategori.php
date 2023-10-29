<?php

namespace App\Models;

use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'status',
    ];

    public function subKategori()
    {
        return $this->hasMany(Produk::class, 'id_kategori', 'id');
    }

    public static function rules($id = null)
    {
        return [
            'name' => [
                'required',
                Rule::unique('kategoris', 'name')->ignore($id),
            ]
        ];
    }
}
