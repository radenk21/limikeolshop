<?php

namespace App\Models;

use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'id_user',
        'no_tracking',
        'fullname',
        'email',
        'phone',
        'pincode',
        'address',
        'status_message',
        'payment_mode',
        'id_payment',
    ];

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class, 'id_order', 'id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'id_order', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
