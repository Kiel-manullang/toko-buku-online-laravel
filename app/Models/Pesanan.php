<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Pesanan extends Model
    {
        use HasFactory;

        // Kolom yang bisa diisi secara massal
        protected $fillable = [
            'user_id',
            'total_harga',
            'status',
            'alamat_pengiriman',
            'metode_pembayaran',
        ];

        /**
         * Dapatkan pengguna yang membuat pesanan ini.
         * Relasi Many-to-One: Banyak pesanan milik satu pengguna.
         */
        public function user()
        {
            return $this->belongsTo(User::class);
        }

        /**
         * Dapatkan item-item yang termasuk dalam pesanan ini.
         * Relasi One-to-Many: Satu pesanan dapat memiliki banyak PesananItem.
         */
        public function pesananItems()
        {
            return $this->hasMany(PesananItem::class);
        }
    }
    