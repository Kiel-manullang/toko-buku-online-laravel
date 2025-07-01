    @extends('admin.layouts.app')

    @section('title', 'Detail Pesanan Admin #' . $pesanan->id)

    @section('content')
        <h1 class="text-4xl font-bold text-gray-800 mb-8">Detail Pesanan #{{ $pesanan->id }}</h1>

        <!-- Pesan Sukses/Error -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-sm" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-sm" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white shadow-xl rounded-lg p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Informasi Pembeli dan Pesanan -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Informasi Pesanan</h2>
                    <div class="space-y-3 text-gray-700">
                        <p class="text-lg"><span class="font-semibold">ID Pesanan:</span> {{ $pesanan->id }}</p>
                        <p class="text-lg"><span class="font-semibold">Tanggal Pesan:</span> {{ $pesanan->created_at->format('d M Y H:i:s') }}</p>
                        <p class="text-lg"><span class="font-semibold">Pembeli:</span> {{ $pesanan->user->name ?? 'N/A' }}</p>
                        <p class="text-lg"><span class="font-semibold">Email Pembeli:</span> {{ $pesanan->user->email ?? 'N/A' }}</p>
                        <p class="text-lg"><span class="font-semibold">Total Harga:</span> <span class="font-bold text-indigo-700">Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</span></p>
                        <div class="flex items-center space-x-2">
                            <span class="font-semibold text-lg">Status:</span>
                            <span class="px-3 py-1 rounded-full text-sm font-semibold uppercase status-{{ $pesanan->status }}">
                                {{ $pesanan->status }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Form Update Status -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Perbarui Status Pesanan</h2>
                    <form action="{{ route('admin.pesanans.updateStatus', $pesanan->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="status" class="block text-md font-medium text-gray-700 mb-2">Pilih Status Baru:</label>
                            <select name="status" id="status" class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="pending" {{ $pesanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="diproses" {{ $pesanan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="dikirim" {{ $pesanan->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                <option value="selesai" {{ $pesanan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="dibatalkan" {{ $pesanan->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-6 rounded-lg shadow-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Perbarui Status
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Daftar Item Pesanan -->
        <div class="bg-white shadow-xl rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Item-item dalam Pesanan</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr class="bg-gray-800 text-white uppercase text-sm leading-normal">
                            <th class="py-4 px-6 text-left rounded-tl-lg">Buku</th>
                            <th class="py-4 px-6 text-right">Harga Satuan (Saat Pesan)</th>
                            <th class="py-4 px-6 text-center">Jumlah</th>
                            <th class="py-4 px-6 text-right rounded-tr-lg">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm">
                        @foreach ($pesanan->pesananItems as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150 ease-in-out">
                                <td class="py-3 px-6 text-left flex items-center space-x-3">
                                    @if ($item->buku->gambar)
                                        <img src="{{ asset('storage/' . $item->buku->gambar) }}" alt="{{ $item->buku->judul }}" class="w-14 h-14 object-cover rounded-md shadow-sm">
                                    @else
                                        <div class="w-14 h-14 bg-gray-200 rounded-md flex items-center justify-center text-gray-500 text-xs">No Image</div>
                                    @endif
                                    <div>
                                        <a href="{{ route('bukus.show', $item->buku->id) }}" target="_blank" class="font-bold text-blue-600 hover:underline text-base">{{ $item->buku->judul }}</a>
                                        <p class="text-gray-500 text-xs">Oleh: {{ $item->buku->penulis }}</p>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-right text-base">Rp{{ number_format($item->harga_saat_pesan, 0, ',', '.') }}</td>
                                <td class="py-3 px-6 text-center text-base font-medium">{{ $item->jumlah }}</td>
                                <td class="py-3 px-6 text-right font-semibold text-lg">Rp{{ number_format($item->jumlah * $item->harga_saat_pesan, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr class="bg-gray-100 font-bold text-lg">
                            <td colspan="3" class="py-4 px-6 text-right rounded-bl-lg">Total Keseluruhan Pesanan:</td>
                            <td class="py-4 px-6 text-right text-indigo-700 rounded-br-lg">Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <a href="{{ route('admin.pesanans.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2.5 px-6 rounded-lg shadow-md transition duration-200 inline-flex items-center">
                &larr; Kembali ke Daftar Pesanan
            </a>
        </div>
    @endsection
    