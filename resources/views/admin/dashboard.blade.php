@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <h1 class="text-4xl font-bold text-gray-800 mb-8">Dashboard Admin</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Card: Total Buku -->
        <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600">Total Buku</p>
                    <h2 class="text-3xl font-bold text-gray-800">{{ $totalBuku }}</h2>
                </div>
                <svg class="h-12 w-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.409 9.333 5 8 5c-4 0-4 10-4 10s1 0 1 0h.463c.563-1.574 1.257-2.946 2.057-4.004v-2.316a1.25 1.25 0 011.25-1.25h1.5a1.25 1.25 0 011.25 1.25v2.316c.8.064 1.494.39 2.057.946H20c1 0 1-2 1-2s0-4-4-4-4-10-4-10z"></path></svg>
            </div>
            <div class="mt-4 text-right">
                <a href="{{ route('admin.bukus.index') }}" class="text-blue-500 hover:text-blue-700 font-medium text-sm">Lihat Detail &rarr;</a>
            </div>
        </div>

        <!-- Card: Total Kategori -->
        <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600">Total Kategori</p>
                    <h2 class="text-3xl font-bold text-gray-800">{{ $totalKategori }}</h2>
                </div>
                <svg class="h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7m-4 0v10m-6 0V7m-6 0V7m-2 0h18M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <div class="mt-4 text-right">
                <a href="{{ route('admin.kategoris.index') }}" class="text-green-500 hover:text-green-700 font-medium text-sm">Lihat Detail &rarr;</a>
            </div>
        </div>

        <!-- Card: Pesanan Pending -->
        <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600">Pesanan Pending</p>
                    <h2 class="text-3xl font-bold text-gray-800">{{ $pesananPending }}</h2>
                </div>
                <svg class="h-12 w-12 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            </div>
            <div class="mt-4 text-right">
                {{-- Link ini sekarang mengarah ke manajemen pesanan admin dengan filter status 'pending' --}}
                <a href="{{ route('admin.pesanans.index', ['status' => 'pending']) }}" class="text-yellow-500 hover:text-yellow-700 font-medium text-sm">Lihat Detail &rarr;</a>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Aksi Cepat</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4"> {{-- Mengurangi kolom karena satu tombol dihapus --}}
            <a href="{{ route('admin.bukus.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg text-center">
                Tambah Buku Baru
            </a>
            <a href="{{ route('admin.kategoris.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg text-center">
                Tambah Kategori Baru
            </a>
            {{-- Tombol "Lihat Semua Pesanan" dihapus karena sudah ada di sidebar dan kartu pesanan pending --}}
        </div>
    </div>
@endsection
