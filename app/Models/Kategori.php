<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // Pastikan ini menggunakan backslash \

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    /**
     * Get the bukus for the Kategori.
     */
    public function bukus()
    {
        return $this->hasMany(Buku::class); // Definisi relasi One-to-Many ke Buku
    }
}
