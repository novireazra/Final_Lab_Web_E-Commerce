<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_buyer',
        'id_restaurant',
        'rating',
        'komentar',
        'tanggal_review',
    ];

    /**
     * Relasi ke tabel users
     */
    public function buyer()
    {
        return $this->belongsTo(User::class, 'id_buyer');
    }

    /**
     * Relasi ke tabel restaurants
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'id_restaurant');
    }
}
