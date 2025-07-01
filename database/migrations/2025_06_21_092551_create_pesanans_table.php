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
            Schema::create('pesanans', function (Blueprint $table) {
                $table->id();
                // Foreign key ke tabel 'users'
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->decimal('total_harga', 10, 2); // Total harga pesanan, 10 digit total, 2 di belakang koma
                $table->enum('status', ['pending', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])->default('pending'); // Status pesanan
                $table->string('alamat_pengiriman')->nullable(); // Alamat pengiriman, bisa dikosongkan sementara
                $table->string('metode_pembayaran')->nullable(); // Metode pembayaran (contoh: 'transfer bank', 'COD')
                $table->timestamps(); // created_at dan updated_at
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('pesanans');
        }
    };
    