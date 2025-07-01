<?php

use Illuminate\Database\Migrations\Migration; // Perhatikan kembali backslash \
use Illuminate\Database\Schema\Blueprint; // Perhatikan kembali backslash \
use Illuminate\Support\Facades\Schema; // Perhatikan kembali backslash \

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('keranjang_items', function (Blueprint $table) {
            $table->id();
            // Foreign key ke tabel 'keranjangs'
            // onDelete('cascade') berarti jika keranjang dihapus, itemnya juga ikut terhapus.
            $table->foreignId('keranjang_id')->constrained('keranjangs')->onDelete('cascade');
            // Foreign key ke tabel 'bukus'
            // onDelete('cascade') berarti jika buku dihapus, itemnya di keranjang juga ikut terhapus.
            $table->foreignId('buku_id')->constrained('bukus')->onDelete('cascade');
            $table->integer('jumlah')->default(1); // Jumlah buku dalam item keranjang
            $table->timestamps(); // created_at dan updated_at

            // Mencegah duplikasi buku dalam satu keranjang
            $table->unique(['keranjang_id', 'buku_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang_items');
    }
};