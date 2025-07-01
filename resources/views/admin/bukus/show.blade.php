@extends('admin.layouts.app')

@section('title', 'Detail Buku - ' . $buku->judul)

@section('content')
    <h2 class="text-3xl font-semibold text-gray-800 mb-6">Detail Buku: {{ $buku->judul }}</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-6 rounded-lg shadow-lg">
        <!-- Kolom Kiri: Gambar -->
        <div>
            @if ($buku->gambar)
                <img src="{{ asset('storage/' . $buku->gambar) }}" alt="{{ $buku->judul }}" class="w-full h-auto object-cover rounded-lg shadow-md">
            @else
                <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500 text-xl shadow-md">
                    Tidak Ada Gambar
                </div>
            @endif
        </div>

        <!-- Kolom Kanan: Detail Teks -->
        <div class="space-y-4">
            <div>
                <p class="text-gray-600 font-bold">Judul:</p>
                <p class="text-gray-800 text-xl font-medium">{{ $buku->judul }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-bold">Penulis:</p>
                <p class="text-gray-800 text-lg">{{ $buku->penulis }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-bold">ISBN:</p>
                <p class="text-gray-800 text-lg">{{ $buku->isbn }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-bold">Harga:</p>
                <p class="text-gray-800 text-lg">Rp{{ number_format($buku->harga, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-bold">Stok:</p>
                <p class="text-gray-800 text-lg">{{ $buku->stok }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-bold">Kategori:</p>
                <p class="text-gray-800 text-lg">{{ $buku->kategori->nama ?? 'Tidak Berkategori' }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-bold">Deskripsi:</p>
                <p class="text-gray-800 text-base leading-relaxed">{{ $buku->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-bold">Terakhir Diperbarui:</p>
                <p class="text-gray-800 text-sm">{{ $buku->updated_at->format('d M Y H:i') }}</p>
            </div>
        </div>
    </div>

    <div class="mt-8 flex justify-end space-x-4">
        <a href="{{ route('admin.bukus.edit', $buku->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
            Edit Buku
        </a>
        <a href="{{ route('admin.bukus.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Kembali ke Daftar Buku
        </a>
    </div>
@endsection
