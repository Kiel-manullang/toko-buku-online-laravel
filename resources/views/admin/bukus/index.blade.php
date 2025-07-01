@extends('admin.layouts.app')

@section('title', 'Daftar Buku')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold text-gray-800">Daftar Buku</h2>
        <a href="{{ route('admin.bukus.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full shadow-md">
            + Tambah Buku Baru
        </a>
    </div>

    <!-- Pesan Sukses/Error -->
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-md" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-md" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Judul</th>
                    <th class="py-3 px-6 text-left">Penulis</th>
                    <th class="py-3 px-6 text-left">ISBN</th>
                    <th class="py-3 px-6 text-right">Harga</th>
                    <th class="py-3 px-6 text-center">Stok</th>
                    <th class="py-3 px-6 text-center">Kategori</th>
                    <th class="py-3 px-6 text-center">Gambar</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse ($bukus as $buku) {{-- Pastikan di sini $bukus (jamak) --}}
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">{{ $buku->id }}</td>
                        <td class="py-3 px-6 text-left">{{ $buku->judul }}</td>
                        <td class="py-3 px-6 text-left">{{ $buku->penulis }}</td>
                        <td class="py-3 px-6 text-left">{{ $buku->isbn }}</td>
                        <td class="py-3 px-6 text-right">Rp{{ number_format($buku->harga, 0, ',', '.') }}</td>
                        <td class="py-3 px-6 text-center">{{ $buku->stok }}</td>
                        <td class="py-3 px-6 text-center">
                            {{ $buku->kategori->nama ?? 'Tidak Berkategori' }}
                        </td>
                        <td class="py-3 px-6 text-center">
                            @if ($buku->gambar)
                                <img src="{{ asset('storage/' . $buku->gambar) }}" alt="{{ $buku->judul }}" class="w-16 h-16 object-cover rounded-lg mx-auto shadow-sm">
                            @else
                                <span class="text-gray-400 text-xs">Tidak ada gambar</span>
                            @endif
                        </td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center space-x-2">
                                <a href="{{ route('admin.bukus.show', $buku->id) }}" class="w-8 h-8 rounded-full bg-blue-500 hover:bg-blue-700 text-white flex items-center justify-center text-xs shadow-md" title="Lihat">👁️</a>
                                <a href="{{ route('admin.bukus.edit', $buku->id) }}" class="w-8 h-8 rounded-full bg-yellow-500 hover:bg-yellow-700 text-white flex items-center justify-center text-xs shadow-md" title="Edit">✏️</a>
                                <form action="{{ route('admin.bukus.destroy', $buku->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-full bg-red-500 hover:bg-red-700 text-white flex items-center justify-center text-xs shadow-md" title="Hapus">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="py-4 px-6 text-center text-gray-500">Tidak ada buku yang ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 flex justify-center">
        {{ $bukus->links('pagination::tailwind') }}
    </div>
@endsection
