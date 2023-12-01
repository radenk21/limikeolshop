<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = [
        'id_user',
        'id_order',
        'no_rekening',
        'jenis_rekening',
        'total_bayar',
        'payment_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function order() : BelongsTo
    {
        return $this->belongsTo(Order::class, 'id_order', 'id');
    }
}
