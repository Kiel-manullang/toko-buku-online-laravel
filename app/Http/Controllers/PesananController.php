<?php

    namespace App\Http\Controllers;

    use App\Models\Pesanan; // Impor Model Pesanan
    use App\Models\Buku; // Impor Model Buku untuk update stok
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB; // Digunakan untuk transaksi database

    class PesananController extends Controller
    {
        /**
         * Menampilkan riwayat pesanan pengguna yang sedang login.
         */
        public function index()
        {
            // Pastikan user sudah login
            if (!Auth::check()) {
                return redirect()->route('login')->with('error', 'Silakan login untuk melihat riwayat pesanan Anda.');
            }

            // Ambil semua pesanan milik user yang sedang login, diurutkan dari terbaru
            // Eager load pesananItems dan buku yang terkait
            $pesanans = Auth::user()->pesanans()->with('pesananItems.buku')->latest()->paginate(10);

            return view('pesanan.index', compact('pesanans'));
        }

        /**
         * Menampilkan detail pesanan tertentu.
         */
        public function show(Pesanan $pesanan)
        {
            // Pastikan pesanan milik user yang sedang login
            if ($pesanan->user_id !== Auth::id()) {
                return redirect()->route('pesanan.index')->with('error', 'Anda tidak memiliki izin untuk melihat pesanan ini.');
            }

            // Eager load pesananItems dan buku yang terkait
            $pesanan->load('pesananItems.buku');

            return view('pesanan.show', compact('pesanan'));
        }

        /**
         * Menampilkan form konfirmasi checkout (opsional, bisa digabung langsung ke store)
         * Untuk project ini, kita akan langsung proses dari keranjang.
         */
        // public function checkoutForm()
        // {
        //     // Logika untuk menampilkan form alamat pengiriman, metode pembayaran, dll.
        //     // Untuk kesederhanaan, kita akan langsung checkout dari keranjang.
        // }

        /**
         * Memproses checkout dari keranjang belanja.
         */
        public function checkout(Request $request)
        {
            // Pastikan user sudah login
            if (!Auth::check()) {
                return redirect()->route('login')->with('error', 'Silakan login untuk melanjutkan checkout.');
            }

            // Dapatkan keranjang pengguna yang sedang login beserta item-itemnya
            $keranjang = Auth::user()->keranjang()->with('keranjangItems.buku')->first();

            // Jika keranjang kosong, redirect kembali
            if (!$keranjang || $keranjang->keranjangItems->isEmpty()) {
                return redirect()->route('keranjang.index')->with('error', 'Keranjang belanja Anda kosong.');
            }

            // Validasi stok buku sebelum proses checkout
            foreach ($keranjang->keranjangItems as $item) {
                if ($item->jumlah > $item->buku->stok) {
                    return redirect()->route('keranjang.index')->with('error', 'Stok buku "' . $item->buku->judul . '" tidak cukup. Stok tersedia: ' . $item->buku->stok . '.');
                }
            }

            // Hitung total harga
            $totalHarga = $keranjang->keranjangItems->sum(function($item) {
                return $item->jumlah * $item->buku->harga;
            });

            // Mulai transaksi database untuk memastikan semua operasi berhasil atau gagal bersamaan
            DB::beginTransaction();

            try {
                // 1. Buat entri di tabel 'pesanans'
                $pesanan = Pesanan::create([
                    'user_id' => Auth::id(),
                    'total_harga' => $totalHarga,
                    'status' => 'pending', // Status awal pesanan
                    'alamat_pengiriman' => 'Alamat default user', // TODO: Bisa ditambahkan form untuk input alamat
                    'metode_pembayaran' => 'Transfer Bank', // TODO: Bisa ditambahkan pilihan metode pembayaran
                ]);

                // 2. Tambahkan setiap item dari keranjang ke 'pesanan_items' dan kurangi stok buku
                foreach ($keranjang->keranjangItems as $item) {
                    $pesanan->pesananItems()->create([
                        'buku_id' => $item->buku_id,
                        'jumlah' => $item->jumlah,
                        'harga_saat_pesan' => $item->buku->harga, // Simpan harga buku saat pesanan dibuat
                    ]);

                    // Kurangi stok buku
                    $buku = $item->buku;
                    $buku->stok -= $item->jumlah;
                    $buku->save(); // Simpan perubahan stok buku
                }

                // 3. Kosongkan keranjang belanja setelah berhasil checkout
                $keranjang->keranjangItems()->delete(); // Hapus semua item dari keranjang

                DB::commit(); // Konfirmasi semua perubahan ke database

                return redirect()->route('pesanan.index')->with('success', 'Pesanan Anda berhasil dibuat!');

            } catch (\Exception $e) {
                DB::rollBack(); // Batalkan semua perubahan jika ada error

                // Log the error for debugging
                // \Log::error('Checkout failed: ' . $e->getMessage());

                return redirect()->route('keranjang.index')->with('error', 'Terjadi kesalahan saat memproses pesanan Anda. Silakan coba lagi. Error: ' . $e->getMessage());
            }
        }

        // Metode untuk admin mengubah status pesanan bisa ditambahkan di sini,
        // atau dibuatkan AdminPesananController terpisah.
    }
    