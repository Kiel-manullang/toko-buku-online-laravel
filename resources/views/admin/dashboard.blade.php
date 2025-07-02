@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="w-full bg-gradient-to-br from-blue-50 via-white to-slate-100 rounded-xl p-6 shadow-xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-4xl font-extrabold text-gray-800">Dashboard Admin</h1>
            <div class="text-right text-sm text-gray-600">
                <div id="tanggalSekarang" class="font-semibold"></div>
                <div id="jamSekarang" class="text-xs"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Card: Total Buku -->
            <div class="bg-white p-6 rounded-2xl shadow-lg border-l-8 border-blue-500 hover:shadow-xl transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600">Total Buku</p>
                        <h2 class="text-3xl font-bold text-blue-700">{{ $totalBuku }}</h2>
                    </div>
                    <svg class="h-12 w-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13..."></path></svg>
                </div>
                <div class="mt-4 text-right">
                    <a href="{{ route('admin.bukus.index') }}" class="text-blue-500 hover:text-blue-700 font-semibold text-sm">Lihat Detail &rarr;</a>
                </div>
            </div>

            <!-- Card: Total Kategori -->
            <div class="bg-white p-6 rounded-2xl shadow-lg border-l-8 border-green-500 hover:shadow-xl transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600">Total Kategori</p>
                        <h2 class="text-3xl font-bold text-green-700">{{ $totalKategori }}</h2>
                    </div>
                    <svg class="h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10..."></path></svg>
                </div>
                <div class="mt-4 text-right">
                    <a href="{{ route('admin.kategoris.index') }}" class="text-green-500 hover:text-green-700 font-semibold text-sm">Lihat Detail &rarr;</a>
                </div>
            </div>

            <!-- Card: Pesanan Pending -->
            <div class="bg-white p-6 rounded-2xl shadow-lg border-l-8 border-yellow-500 hover:shadow-xl transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600">Pesanan Pending</p>
                        <h2 class="text-3xl font-bold text-yellow-600">{{ $pesananPending }}</h2>
                    </div>
                    <svg class="h-12 w-12 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2..."></path></svg>
                </div>
                <div class="mt-4 text-right">
                    <a href="{{ route('admin.pesanans.index', ['status' => 'pending']) }}" class="text-yellow-500 hover:text-yellow-700 font-semibold text-sm">Lihat Detail &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Aksi Cepat -->
        <div class="bg-white p-6 rounded-2xl shadow-lg">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Aksi Cepat</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('admin.bukus.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-md text-center transition">
                    Tambah Buku Baru
                </a>
                <a href="{{ route('admin.kategoris.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow-md text-center transition">
                    Tambah Kategori Baru
                </a>
            </div>
        </div>
    </div>

@endsection
