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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // Judul buku
            $table->string('penulis'); // Penulis
            $table->string('isbn')->unique(); // ISBN, harus unik
            $table->text('deskripsi')->nullable(); // Deskripsi, boleh kosong
            $table->decimal('harga', 8, 2); // Harga (contoh: 999999.99)
            $table->integer('stok')->default(0); // Stok, default 0
            // Jika nanti ada kategori, bisa ditambahkan foreign key di sini:
            // $table->foreignId('kategori_id')->nullable()->constrained('kategoris')->onDelete('set null');
            $table->string('gambar')->nullable(); // Path gambar sampul buku
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};