<?php

    namespace App\Http\Controllers;

    use App\Models\Buku;
    use App\Models\Kategori; // Tambahkan ini
    use Illuminate\Http\Request;

    class HomeController extends Controller
    {
        public function index(Request $request)
        {
            $query = Buku::query();

            // Filter berdasarkan pencarian
            if ($request->has('search') && $request->search != '') {
                $search = $request->search;
                $query->where('judul', 'like', '%' . $search . '%')
                      ->orWhere('penulis', 'like', '%' . $search . '%')
                      ->orWhere('isbn', 'like', '%' . $search . '%');
            }

            // Filter berdasarkan kategori
            if ($request->has('kategori') && $request->kategori != '') {
                $query->where('kategori_id', $request->kategori);
            }

            // Ambil buku dengan eager loading kategori dan paginate
            $bukus = $query->with('kategori')->latest()->paginate(12); // Menampilkan 12 buku per halaman

            // Ambil semua kategori untuk filter dropdown
            $kategoris = Kategori::orderBy('nama')->get(); // Tambahkan ini

            return view('welcome', compact('bukus', 'kategoris')); // Kirimkan $kategoris ke view
        }

        public function show(Buku $buku)
        {
            $buku->load('kategori'); // Eager load relasi 'kategori'
            return view('bukus.show', compact('buku'));
        }
    }
    