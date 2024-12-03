<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_seller',
        'nama_restaurant',
        'deskripsi',
        'alamat',
        'status_buka',
        'image',
    ];

    /**
     * Relasi ke tabel users
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'id_seller');
    }

    /**
     * Relasi ke tabel menus
     */
    public function menus()
    {
        return $this->hasMany(Menu::class, 'id_restaurant');
    }

    /**
     * Mendapatkan URL gambar
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/default-restaurant.jpg');
    }
}
