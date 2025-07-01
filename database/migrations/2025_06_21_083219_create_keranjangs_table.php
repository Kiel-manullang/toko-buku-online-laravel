<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema; // Perhatikan kembali backslash \

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->id();
            // User yang memiliki keranjang ini. Foreign key ke tabel 'users'.
            // onDelete('cascade') berarti jika user dihapus, keranjangnya juga ikut terhapus.
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjangs');
    }
};