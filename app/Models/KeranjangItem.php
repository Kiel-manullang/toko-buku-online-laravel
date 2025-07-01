<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model; // Pastikan ini menggunakan backslash \

    class KeranjangItem extends Model
    {
        use HasFactory;

        // Tentukan nama tabel jika tidak mengikuti konvensi jamak dari nama Model
        // protected $table = 'keranjang_items'; // Opsional, jika Anda yakin namanya sudah benar

        // Kolom yang bisa diisi secara massal
        protected $fillable = [
            'keranjang_id',
            'buku_id',
            'jumlah',
        ];

        /**
         * Dapatkan keranjang yang memiliki item ini.
         * Relasi Many-to-One: Banyak item keranjang milik satu Keranjang.
         */
        public function keranjang()
        {
            return $this->belongsTo(Keranjang::class);
        }

        /**
         * Dapatkan buku yang terkait dengan item ini.
         * Relasi Many-to-One: Banyak item keranjang terkait dengan satu Buku.
         */
        public function buku()
        {
            return $this->belongsTo(Buku::class);
        }
    }
    