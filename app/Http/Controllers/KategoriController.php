<?php
    // Pastikan TIDAK ADA SPASI, BARIS KOSONG, atau KARAKTER APAPUN sebelum baris ini.
    // <?php harus di baris 1, karakter 1.
    namespace App\Http\Controllers;

    use App\Models\Kategori; // Impor Model Kategori
    use Illuminate\Http\Request; 

    class KategoriController extends Controller
    {
        /**
         * Menampilkan daftar semua kategori.
         */
        public function index()
        {
            // Ambil semua data kategori dari database
            $kategoris = Kategori::latest()->paginate(10); // Mengambil 10 kategori per halaman, diurutkan dari terbaru

            // Kirim data kategori ke view
            return view('admin.kategoris.index', compact('kategoris'));
        }

        /**
         * Menampilkan form untuk membuat kategori baru.
         */
        public function create()
        {
            return view('admin.kategoris.create');
        }

        /**
         * Menyimpan kategori baru ke database.
         */
        public function store(Request $request)
        {
            // Validasi data yang masuk dari form
            $request->validate([
                'nama' => 'required|string|unique:kategoris,nama|max:255', // Nama kategori harus unik
                'deskripsi' => 'nullable|string',
            ]);

            // Buat entri kategori baru di database
            Kategori::create([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
            ]);

            // Redirect ke halaman daftar kategori dengan pesan sukses
            return redirect()->route('admin.kategoris.index')->with('success', 'Kategori berhasil ditambahkan!');
        }

        /**
         * Menampilkan detail kategori tertentu.
         */
        public function show(Kategori $kategori)
        {
            return view('admin.kategoris.show', compact('kategori'));
        }

        /**
         * Menampilkan form untuk mengedit kategori.
         */
        public function edit(Kategori $kategori)
        {
            return view('admin.kategoris.edit', compact('kategori'));
        }

        /**
         * Memperbarui data kategori di database.
         */
        public function update(Request $request, Kategori $kategori)
        {
            // Validasi data
            $request->validate([
                'nama' => 'required|string|unique:kategoris,nama,' . $kategori->id . '|max:255', // Kecualikan nama kategori saat ini
                'deskripsi' => 'nullable|string',
            ]);

            // Update data kategori
            $kategori->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
            ]);

            return redirect()->route('admin.kategoris.index')->with('success', 'Kategori berhasil diperbarui!');
        }

        /**
         * Menghapus kategori dari database.
         */
        public function destroy(Kategori $kategori)
        {
            // Hapus kategori dari database
            $kategori->delete();

            return redirect()->route('admin.kategoris.index')->with('success', 'Kategori berhasil dihapus!');
        }
    }
    