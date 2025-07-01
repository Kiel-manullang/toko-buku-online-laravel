    @extends('admin.layouts.app')

    @section('title', 'Daftar Kategori')

    @section('content')
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-semibold text-gray-800">Daftar Kategori</h2>
            <a href="{{ route('admin.kategoris.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full shadow-md">
                + Tambah Kategori Baru
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
                        <th class="py-3 px-6 text-left">Nama Kategori</th>
                        <th class="py-3 px-6 text-left">Deskripsi</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($kategoris as $kategori)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $kategori->id }}</td>
                            <td class="py-3 px-6 text-left">{{ $kategori->nama }}</td>
                            <td class="py-3 px-6 text-left">{{ $kategori->deskripsi ?? 'Tidak ada deskripsi.' }}</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center space-x-2">
                                    <a href="{{ route('admin.kategoris.show', $kategori->id) }}" class="w-8 h-8 rounded-full bg-blue-500 hover:bg-blue-700 text-white flex items-center justify-center text-xs shadow-md" title="Lihat">👁️</a>
                                    <a href="{{ route('admin.kategoris.edit', $kategori->id) }}" class="w-8 h-8 rounded-full bg-yellow-500 hover:bg-yellow-700 text-white flex items-center justify-center text-xs shadow-md" title="Edit">✏️</a>
                                    <form action="{{ route('admin.kategoris.destroy', $kategori->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Ini juga akan memengaruhi buku yang terkait!');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-full bg-red-500 hover:bg-red-700 text-white flex items-center justify-center text-xs shadow-md" title="Hapus">🗑️</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 px-6 text-center text-gray-500">Tidak ada kategori yang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4 flex justify-center">
            {{ $kategoris->links('pagination::tailwind') }}
        </div>
    @endsection
    