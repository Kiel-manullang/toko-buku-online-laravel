    @extends('admin.layouts.app')

    @section('title', 'Detail Kategori - ' . $kategori->nama)

    @section('content')
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Detail Kategori: {{ $kategori->nama }}</h2>

        <div class="bg-white p-6 rounded-lg shadow-lg space-y-4">
            <div>
                <p class="text-gray-600 font-bold">Nama Kategori:</p>
                <p class="text-gray-800 text-xl font-medium">{{ $kategori->nama }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-bold">Deskripsi:</p>
                <p class="text-gray-800 text-base leading-relaxed">{{ $kategori->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-bold">Dibuat Pada:</p>
                <p class="text-gray-800 text-sm">{{ $kategori->created_at->format('d M Y H:i') }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-bold">Terakhir Diperbarui:</p>
                <p class="text-gray-800 text-sm">{{ $kategori->updated_at->format('d M Y H:i') }}</p>
            </div>
        </div>

        <div class="mt-8 flex justify-end space-x-4">
            <a href="{{ route('admin.kategoris.edit', $kategori->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                Edit Kategori
            </a>
            <a href="{{ route('admin.kategoris.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Kembali ke Daftar Kategori
            </a>
        </div>
    @endsection
    