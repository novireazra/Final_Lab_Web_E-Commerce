<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_order',
        'id_menu',
        'quantity',
        'price',
        'subtotal',
    ];

    /**
     * Relasi ke tabel orders
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }

    /**
     * Relasi ke tabel menus
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
}
