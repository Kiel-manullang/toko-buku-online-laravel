<?php

    namespace App\Http\Controllers;

    use App\Models\Buku; // Impor Model Buku
    use App\Models\Keranjang; // Impor Model Keranjang
    use App\Models\KeranjangItem; // Impor Model KeranjangItem
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class KeranjangController extends Controller
    {
        /**
         * Menampilkan isi keranjang belanja pengguna yang sedang login.
         */
        public function index()
        {
            // Pastikan user sudah login
            if (!Auth::check()) {
                return redirect()->route('login')->with('error', 'Silakan login untuk melihat keranjang Anda.');
            }

            // Dapatkan keranjang pengguna yang sedang login
            // Jika belum ada, buat keranjang baru untuk user ini
            $keranjang = Auth::user()->keranjang()->with('keranjangItems.buku')->firstOrCreate([]);

            // Eager load buku untuk setiap item keranjang
            $keranjangItems = $keranjang->keranjangItems;

            // Hitung total harga keranjang
            $totalHarga = $keranjangItems->sum(function($item) {
                return $item->jumlah * $item->buku->harga;
            });

            return view('keranjang.index', compact('keranjangItems', 'totalHarga'));
        }

        /**
         * Menambah buku ke keranjang belanja.
         */
        public function tambah(Request $request, Buku $buku)
        {
            // Validasi jumlah buku yang akan ditambahkan
            $request->validate([
                'jumlah' => 'required|integer|min:1|max:' . $buku->stok,
            ]);

            // Dapatkan keranjang pengguna yang sedang login atau buat jika belum ada
            $keranjang = Auth::user()->keranjang()->firstOrCreate([]);

            // Cek apakah buku sudah ada di keranjang
            $keranjangItem = $keranjang->keranjangItems()->where('buku_id', $buku->id)->first();

            if ($keranjangItem) {
                // Jika sudah ada, update jumlahnya
                $newJumlah = $keranjangItem->jumlah + $request->jumlah;
                if ($newJumlah > $buku->stok) {
                    return back()->with('error', 'Jumlah melebihi stok yang tersedia (' . $buku->stok . ').');
                }
                $keranjangItem->update(['jumlah' => $newJumlah]);
            } else {
                // Jika belum ada, tambahkan item baru ke keranjang
                $keranjang->keranjangItems()->create([
                    'buku_id' => $buku->id,
                    'jumlah' => $request->jumlah,
                ]);
            }

            return redirect()->route('keranjang.index')->with('success', 'Buku berhasil ditambahkan ke keranjang!');
        }

        /**
         * Mengupdate jumlah buku di keranjang belanja.
         */
        public function update(Request $request, KeranjangItem $item)
        {
            // Pastikan item keranjang milik user yang sedang login
            if ($item->keranjang->user_id !== Auth::id()) {
                return back()->with('error', 'Anda tidak memiliki izin untuk mengedit item ini.');
            }

            // Ambil data buku terkait untuk validasi stok
            $buku = $item->buku;

            // Validasi jumlah yang diupdate
            $request->validate([
                'jumlah' => 'required|integer|min:1|max:' . $buku->stok,
            ]);

            $item->update(['jumlah' => $request->jumlah]);

            return redirect()->route('keranjang.index')->with('success', 'Jumlah buku di keranjang berhasil diperbarui!');
        }

        /**
         * Menghapus buku dari keranjang belanja.
         */
        public function hapus(KeranjangItem $item)
        {
            // Pastikan item keranjang milik user yang sedang login
            if ($item->keranjang->user_id !== Auth::id()) {
                return back()->with('error', 'Anda tidak memiliki izin untuk menghapus item ini.');
            }

            $item->delete();

            return redirect()->route('keranjang.index')->with('success', 'Buku berhasil dihapus dari keranjang!');
        }
    }
    