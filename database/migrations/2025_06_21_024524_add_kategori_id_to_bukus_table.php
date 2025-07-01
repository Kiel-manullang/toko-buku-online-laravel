<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bukus', function (Blueprint $table) {
            // Menambahkan kolom kategori_id sebagai foreign key
            // `nullable()` agar buku bisa tanpa kategori di awal (opsional)
            // `constrained('kategoris')` untuk menghubungkan ke tabel 'kategoris'
            // `onDelete('set null')` berarti jika kategori dihapus, kategori_id di buku akan menjadi NULL
            $table->foreignId('kategori_id')
                  ->nullable()
                  ->constrained('kategoris')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bukus', function (Blueprint $table) {
            // Saat rollback, hapus foreign key terlebih dahulu
            $table->dropConstrainedForeignId('kategori_id');
        });
    }
};