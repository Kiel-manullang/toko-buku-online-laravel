@extends('admin.layouts.app')

@section('title', 'Tambah Buku Baru')

@section('content')
    <h2 class="text-3xl font-semibold text-gray-800 mb-6">Tambah Buku Baru</h2>

    <!-- Pesan Error Validasi -->
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-md" role="alert">
            <p class="font-bold">Ada masalah dengan input Anda:</p>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.bukus.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-lg shadow-lg">
        @csrf

        <div>
            <label for="judul" class="block text-sm font-medium text-gray-700">Judul Buku</label>
            <input type="text" name="judul" id="judul" value="{{ old('judul') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
        </div>

        <div>
            <label for="penulis" class="block text-sm font-medium text-gray-700">Penulis</label>
            <input type="text" name="penulis" id="penulis" value="{{ old('penulis') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
        </div>

        <div>
            <label for="isbn" class="block text-sm font-medium text-gray-700">ISBN</label>
            <input type="text" name="isbn" id="isbn" value="{{ old('isbn') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
        </div>

        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('deskripsi') }}</textarea>
        </div>

        <div>
            <label for="harga" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
            <input type="number" name="harga" id="harga" value="{{ old('harga') }}" step="0.01" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required min="0">
        </div>

        <div>
            <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
            <input type="number" name="stok" id="stok" value="{{ old('stok') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required min="0">
        </div>

        <div>
            <label for="kategori_id" class="block text-sm font-medium text-gray-700">Kategori</label>
            <select name="kategori_id" id="kategori_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                <option value="">-- Pilih Kategori (Opsional) --</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar Sampul</label>
            <input type="file" name="gambar" id="gambar" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.bukus.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Batal
            </a>
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Simpan Buku
            </button>
        </div>
    </form>
@endsection
