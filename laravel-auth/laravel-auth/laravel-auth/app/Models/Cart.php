<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_menu',
        'jumlah',
        'sub_total',
    ];

    /**
     * Relasi ke tabel users
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Relasi ke tabel menus
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
}
