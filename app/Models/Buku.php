<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model; // Pastikan ini menggunakan backslash \

    class Buku extends Model
    {
        use HasFactory;

        protected $fillable = [
            'judul',
            'penulis',
            'isbn',
            'deskripsi',
            'harga',
            'stok',
            'gambar',
            'kategori_id', // Pastikan ini ada di fillable
        ];

        /**
         * Get the kategori that owns the Buku.
         */
        public function kategori()
        {
            return $this->belongsTo(Kategori::class); // Definisi relasi Many-to-One ke Kategori
        }

        /**
         * Dapatkan item-item pesanan yang terkait dengan buku ini.
         * Relasi One-to-Many: Satu buku dapat muncul di banyak PesananItem.
         */
        public function pesananItems() // <-- TAMBAHKAN FUNGSI INI
        {
            return $this->hasMany(PesananItem::class);
        }
    }
    