<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Keranjang extends Model
    {
        use HasFactory;

        // Kolom yang bisa diisi secara massal
        protected $fillable = [
            'user_id',
        ];

        /**
         * Dapatkan pengguna yang memiliki keranjang ini.
         * Relasi One-to-One: Setiap keranjang dimiliki oleh satu pengguna.
         */
        public function user()
        {
            return $this->belongsTo(User::class);
        }

        /**
         * Dapatkan item-item di dalam keranjang ini.
         * Relasi One-to-Many: Satu keranjang dapat memiliki banyak KeranjangItem.
         */
        public function keranjangItems()
        {
            return $this->hasMany(KeranjangItem::class);
        }
    }
    