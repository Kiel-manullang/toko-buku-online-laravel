<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Diperlukan untuk mengakses Auth::user()

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard pengguna.
     * Logika dasar, bisa diperluas di masa depan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Data yang mungkin ingin ditampilkan di dashboard pengguna
        // Untuk saat ini, kita tidak mengirimkan data spesifik ke view,
        // karena view dashboard.blade.php sudah mengambil data langsung dari Auth::user().
        // Namun, jika Anda ingin mengambil data tambahan (misalnya, 3 pesanan terakhir),
        // Anda bisa melakukannya di sini dan mengirimkannya ke view.

        return view('dashboard'); // Mengarahkan ke resources/views/dashboard.blade.php
    }
}
