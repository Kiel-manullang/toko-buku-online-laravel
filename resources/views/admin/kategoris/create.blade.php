    @extends('admin.layouts.app')

    @section('title', 'Tambah Kategori Baru')

    @section('content')
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Tambah Kategori Baru</h2>

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

        <form action="{{ route('admin.kategoris.store') }}" method="POST" class="space-y-6 bg-white p-6 rounded-lg shadow-lg">
            @csrf

            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.kategoris.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Batal
                </a>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Simpan Kategori
                </button>
            </div>
        </form>
    @endsection
    