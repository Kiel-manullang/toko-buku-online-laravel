@extends('admin.layouts.app')

@section('title', 'Detail Pengguna - ' . $user->name)

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Detail Pengguna: {{ $user->name }}</h1>

    <div class="bg-white shadow-xl rounded-lg overflow-hidden p-6 space-y-4">
        <div>
            <p class="text-gray-600 font-bold">Nama:</p>
            <p class="text-gray-800 text-lg">{{ $user->name }}</p>
        </div>
        <div>
            <p class="text-gray-600 font-bold">Email:</p>
            <p class="text-gray-800 text-lg">{{ $user->email }}</p>
        </div>
        <div>
            <p class="text-gray-600 font-bold">Role:</p>
            <p class="text-gray-800 text-lg">
                <span class="px-3 py-1 rounded-full text-sm font-semibold uppercase {{ $user->role === 'admin' ? 'bg-purple-200 text-purple-800' : 'bg-gray-200 text-gray-800' }}">
                    {{ $user->role }}
                </span>
            </p>
        </div>
        <div>
            <p class="text-gray-600 font-bold">Terdaftar Sejak:</p>
            <p class="text-gray-800 text-lg">{{ $user->created_at->format('d M Y H:i') }}</p>
        </div>
        <div>
            <p class="text-gray-600 font-bold">Terakhir Diperbarui:</p>
            <p class="text-gray-800 text-lg">{{ $user->updated_at->format('d M Y H:i') }}</p>
        </div>
    </div>

    <div class="mt-8 flex justify-end space-x-4">
        {{-- Tombol edit pengguna (opsional, akan ditambahkan nanti jika diperlukan) --}}
        {{-- <a href="{{ route('admin.users.edit', $user->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
            Edit Pengguna
        </a> --}}
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Kembali ke Daftar Pengguna
        </a>
    </div>
@endsection
