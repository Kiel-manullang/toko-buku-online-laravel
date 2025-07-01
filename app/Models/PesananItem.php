<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class PesananItem extends Model
    {
        use HasFactory;

        // Kolom yang bisa diisi secara massal
        protected $fillable = [
            'pesanan_id',
            'buku_id',
            'jumlah',
            'harga_saat_pesan', // Ini penting untuk mencatat harga saat pesanan dibuat
        ];

        /**
         * Dapatkan pesanan yang memiliki item ini.
         * Relasi Many-to-One: Banyak item pesanan milik satu Pesanan.
         */
        public function pesanan()
        {
            return $this->belongsTo(Pesanan::class);
        }

        /**
         * Dapatkan buku yang terkait dengan item ini.
         * Relasi Many-to-One: Banyak item pesanan terkait dengan satu Buku.
         */
        public function buku()
        {
            return $this->belongsTo(Buku::class);
        }
    }
    