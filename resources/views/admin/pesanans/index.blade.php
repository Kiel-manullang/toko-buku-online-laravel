@extends('admin.layouts.app')

@section('title', 'Manajemen Pesanan Admin')

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <h1 class="text-4xl font-bold text-gray-800"></h1>
        @if(isset($currentStatusFilter) && $currentStatusFilter)
            <div class="flex items-center space-x-3">
                <span class="text-lg font-semibold text-gray-700">Menampilkan: <span class="px-3 py-1 rounded-full text-sm font-bold uppercase status-{{ $currentStatusFilter }}">{{ $currentStatusFilter }}</span></span>
                <a href="{{ route('admin.pesanans.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg shadow-md transition duration-200">Reset Filter</a>
            </div>
        @endif
    </div>

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

    <div class="bg-white shadow-xl rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="bg-gray-800 text-white uppercase text-sm leading-normal">
                        <th class="py-4 px-6 text-left rounded-tl-lg">ID Pesanan</th>
                        <th class="py-4 px-6 text-left">Pembeli</th>
                        <th class="py-4 px-6 text-left">Email</th>
                        <th class="py-4 px-6 text-center">Jumlah Item</th>
                        <th class="py-4 px-6 text-right">Total Harga</th>
                        <th class="py-4 px-6 text-center">Status</th>
                        <th class="py-4 px-6 text-center">Tanggal Pesan</th>
                        <th class="py-4 px-6 text-center rounded-tr-lg">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    @forelse ($pesanans as $pesanan)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="py-3 px-6 text-left whitespace-nowrap font-semibold">{{ $pesanan->id }}</td>
                            <td class="py-3 px-6 text-left">{{ $pesanan->user->name ?? 'N/A' }}</td>
                            <td class="py-3 px-6 text-left">{{ $pesanan->user->email ?? 'N/A' }}</td>
                            <td class="py-3 px-6 text-center">{{ $pesanan->pesananItems->sum('jumlah') }}</td>
                            <td class="py-3 px-6 text-right font-medium">Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                            <td class="py-3 px-6 text-center">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold uppercase status-{{ $pesanan->status }}">
                                    {{ $pesanan->status }}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-center">{{ $pesanan->created_at->format('d M Y H:i') }}</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.pesanans.show', $pesanan->id) }}" class="w-9 h-9 rounded-full bg-blue-500 hover:bg-blue-600 text-white flex items-center justify-center text-xs shadow-md transition duration-200" title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.pesanans.destroy', $pesanan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini? Ini juga akan menghapus item terkait.');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-9 h-9 rounded-full bg-red-500 hover:bg-red-600 text-white flex items-center justify-center text-xs shadow-md transition duration-200" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-6 px-6 text-center text-gray-500 text-lg">Tidak ada pesanan yang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-8 flex justify-center">
        {{ $pesanans->links('pagination::tailwind') }}
    </div>
@endsection
