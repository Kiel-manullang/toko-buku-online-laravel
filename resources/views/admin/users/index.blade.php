@extends('admin.layouts.app')

@section('title', 'Manajemen Pengguna Admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-4xl font-bold text-gray-800">Manajemen Pengguna</h1>
        {{-- Tombol untuk menambah pengguna baru (opsional, akan diimplementasikan nanti jika diperlukan) --}}
        {{-- <a href="{{ route('admin.users.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">
            + Tambah Pengguna Baru
        </a> --}}
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
                        <th class="py-4 px-6 text-left rounded-tl-lg">ID</th>
                        <th class="py-4 px-6 text-left">Nama</th>
                        <th class="py-4 px-6 text-left">Email</th>
                        <th class="py-4 px-6 text-center">Role</th>
                        <th class="py-4 px-6 text-center">Terdaftar Sejak</th>
                        <th class="py-4 px-6 text-center rounded-tr-lg">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    @forelse ($users as $user)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="py-3 px-6 text-left whitespace-nowrap font-semibold">{{ $user->id }}</td>
                            <td class="py-3 px-6 text-left">{{ $user->name }}</td>
                            <td class="py-3 px-6 text-left">{{ $user->email }}</td>
                            <td class="py-3 px-6 text-center">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold uppercase {{ $user->role === 'admin' ? 'bg-purple-200 text-purple-800' : 'bg-gray-200 text-gray-800' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-center">{{ $user->created_at->format('d M Y H:i') }}</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="w-9 h-9 rounded-full bg-blue-500 hover:bg-blue-600 text-white flex items-center justify-center text-xs shadow-md transition duration-200" title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    {{-- Tombol edit dan hapus (opsional, akan ditambahkan nanti jika diperlukan) --}}
                                    {{-- <a href="{{ route('admin.users.edit', $user->id) }}" class="w-9 h-9 rounded-full bg-yellow-500 hover:bg-yellow-600 text-white flex items-center justify-center text-xs shadow-md transition duration-200" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-9 h-9 rounded-full bg-red-500 hover:bg-red-600 text-white flex items-center justify-center text-xs shadow-md transition duration-200" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form> --}}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-6 px-6 text-center text-gray-500 text-lg">Tidak ada pengguna yang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-8 flex justify-center">
        {{ $users->links('pagination::tailwind') }}
    </div>
@endsection
