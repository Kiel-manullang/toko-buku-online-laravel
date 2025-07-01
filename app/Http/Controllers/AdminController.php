<?php

namespace App\Http\Controllers;

use App\Models\Buku; // Tambahkan ini
use App\Models\Kategori; // Tambahkan ini
use App\Models\Pesanan; // Tambahkan ini
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Menampilkan dashboard admin.
     * Mengambil data statistik untuk ditampilkan di dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil data statistik untuk dashboard
        $totalBuku = Buku::count();
        $totalKategori = Kategori::count();
        $pesananPending = Pesanan::where('status', 'pending')->count();
        // Anda bisa menambahkan statistik lain seperti total user, total penjualan, dll.

        return view('admin.dashboard', compact('totalBuku', 'totalKategori', 'pesananPending'));
    }
}
