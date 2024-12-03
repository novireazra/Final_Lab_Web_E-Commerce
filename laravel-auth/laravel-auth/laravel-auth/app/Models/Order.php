<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_buyer',
        'tanggal_pesanan',
        'total_harga',
        'status_order',
    ];

    /**
     * Relasi ke tabel users
     */
    public function buyer()
    {
        return $this->belongsTo(User::class, 'id_buyer');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'id_order');
    }
}
