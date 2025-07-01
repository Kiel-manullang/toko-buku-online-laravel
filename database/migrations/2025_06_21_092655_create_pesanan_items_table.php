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
            Schema::create('pesanan_items', function (Blueprint $table) {
                $table->id();
                // Foreign key ke tabel 'pesanans'
                $table->foreignId('pesanan_id')->constrained('pesanans')->onDelete('cascade');
                // Foreign key ke tabel 'bukus'
                $table->foreignId('buku_id')->constrained('bukus')->onDelete('cascade');
                $table->integer('jumlah'); // Jumlah buku dalam item pesanan
                $table->decimal('harga_saat_pesan', 10, 2); // Harga buku saat pesanan dibuat (penting karena harga bisa berubah)
                $table->timestamps(); // created_at dan updated_at

                // Mencegah duplikasi buku dalam satu pesanan
                $table->unique(['pesanan_id', 'buku_id']);
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('pesanan_items');
        }
    };
    