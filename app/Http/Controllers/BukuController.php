<?php
// Pastikan TIDAK ADA SPASI, BARIS KOSONG, atau KARAKTER APAPUN sebelum baris ini.
// <?php harus di baris 1, karakter 1.
namespace App\Http\Controllers; // Pastikan ini menggunakan backslash \

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request; // Pastikan ini menggunakan backslash \
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Menampilkan daftar semua buku.
     */
    public function index()
    {
        // Ambil semua data buku dari database dan eager load relasi 'kategori'
        $bukus = Buku::with('kategori')->latest()->paginate(10);
        return view('admin.bukus.index', compact('bukus'));
    }

    /**
     * Menampilkan form untuk membuat buku baru.
     */
    public function create()
    {
        // Ambil semua kategori untuk dropdown
        $kategoris = Kategori::orderBy('nama')->get();
        return view('admin.bukus.create', compact('kategoris'));
    }

    /**
     * Menyimpan buku baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk dari form
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'isbn' => 'required|string|unique:bukus,isbn|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_id' => 'nullable|exists:kategoris,id', // Validasi bahwa kategori_id ada di tabel kategoris
        ]);

        $gambarPath = null;
        // Jika ada gambar yang diupload, simpan gambarnya
        if ($request->hasFile('gambar')) {
            // Simpan gambar di folder 'public/gambar_buku'
            $gambarPath = $request->file('gambar')->store('gambar_buku', 'public');
        }

        // Buat entri buku baru di database
        Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'isbn' => $request->isbn,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $gambarPath, // Simpan path gambarnya
            'kategori_id' => $request->kategori_id, // Simpan kategori_id
        ]);

        // Redirect ke halaman daftar buku dengan pesan sukses
        return redirect()->route('admin.bukus.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail buku tertentu.
     */
    public function show(Buku $buku)
    {
        // Eager load relasi 'kategori' untuk memastikan data kategori tersedia di view
        $buku->load('kategori');
        return view('admin.bukus.show', compact('buku'));
    }

    /**
     * Menampilkan form untuk mengedit buku.
     */
    public function edit(Buku $buku)
    {
        // Ambil semua kategori untuk dropdown
        $kategoris = Kategori::orderBy('nama')->get();
        return view('admin.bukus.edit', compact('buku', 'kategoris'));
    }

    /**
     * Memperbarui data buku di database.
     */
    public function update(Request $request, Buku $buku)
    {
        // Validasi data
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'isbn' => 'required|string|unique:bukus,isbn,' . $buku->id . '|max:255', // Kecualikan ISBN buku saat ini
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_id' => 'nullable|exists:kategoris,id',
        ]);

        $gambarPath = $buku->gambar; // Gunakan gambar lama secara default
        // Jika ada gambar baru yang diupload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($buku->gambar) {
                Storage::disk('public')->delete($buku->gambar);
            }
            // Simpan gambar baru
            $gambarPath = $request->file('gambar')->store('gambar_buku', 'public');
        }

        // Update data buku
        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'isbn' => $request->isbn,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $gambarPath,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('admin.bukus.index')->with('success', 'Buku berhasil diperbarui!');
    }

    /**
     * Menghapus buku dari database.
     */
    public function destroy(Buku $buku)
    {
        // Hapus gambar terkait jika ada
        if ($buku->gambar) {
            Storage::disk('public')->delete($buku->gambar);
        }

        // Hapus buku dari database
        $buku->delete();

        return redirect()->route('admin.bukus.index')->with('success', 'Buku berhasil dihapus!');
    }
}
