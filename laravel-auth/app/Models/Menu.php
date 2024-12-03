<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi
     */
    protected $fillable = [
        'id_restaurant',
        'nama_menu',
        'deskripsi_menu',
        'harga',
        'status',
        'kategori',
        'image',
        'stock', // Menambahkan kolom stock
    ];

    /**
     * Relasi ke tabel restaurants
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'id_restaurant');
    }

    /**
     * Accessor untuk mendapatkan URL gambar
     */
    public function getImageUrlAttribute()
    {
        return $this->image 
            ? asset('storage/' . $this->image) 
            : asset('images/default-menu.jpg');
    }
}
