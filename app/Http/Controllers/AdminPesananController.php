<?php

    namespace App\Http\Controllers;

    use App\Models\Pesanan;
    use Illuminate\Http\Request;

    class AdminPesananController extends Controller
    {
        /**
         * Menampilkan daftar semua pesanan untuk admin, dengan opsi filter status.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\View\View
         */
        public function index(Request $request)
        {
            $query = Pesanan::with(['user', 'pesananItems.buku']);

            // Filter berdasarkan status jika ada parameter 'status' dalam request
            if ($request->has('status') && in_array($request->status, ['pending', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])) {
                $query->where('status', $request->status);
            }

            // Mengurutkan dari yang terbaru dan melakukan paginasi
            $pesanans = $query->latest()->paginate(10);

            // Simpan status filter saat ini untuk digunakan di tampilan (jika diperlukan)
            $currentStatusFilter = $request->status;

            return view('admin.pesanans.index', compact('pesanans', 'currentStatusFilter'));
        }

        /**
         * Menampilkan detail pesanan tertentu untuk admin.
         *
         * @param  \App\Models\Pesanan  $pesanan
         * @return \Illuminate\View\View
         */
        public function show(Pesanan $pesanan)
        {
            $pesanan->load(['user', 'pesananItems.buku']);
            return view('admin.pesanans.show', compact('pesanan'));
        }

        /**
         * Memperbarui status pesanan.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Models\Pesanan  $pesanan
         * @return \Illuminate\Http\RedirectResponse
         */
        public function updateStatus(Request $request, Pesanan $pesanan)
        {
            $request->validate([
                'status' => 'required|in:pending,diproses,dikirim,selesai,dibatalkan',
            ]);

            $pesanan->status = $request->status;
            $pesanan->save();

            return redirect()->route('admin.pesanans.show', $pesanan->id)
                             ->with('success', 'Status pesanan berhasil diperbarui.');
        }

        /**
         * Menghapus pesanan.
         *
         * @param  \App\Models\Pesanan  $pesanan
         * @return \Illuminate\Http\RedirectResponse
         */
        public function destroy(Pesanan $pesanan)
        {
            $pesanan->delete();

            return redirect()->route('admin.pesanans.index')
                             ->with('success', 'Pesanan berhasil dihapus.');
        }
    }
    