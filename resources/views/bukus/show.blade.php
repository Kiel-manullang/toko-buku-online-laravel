    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $buku->judul }} - Toko Buku Online</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="bg-gray-100 font-sans leading-normal tracking-normal">

        <!-- Navbar Public -->
        <nav class="bg-gray-800 p-4 text-white shadow-lg">
            <div class="container mx-auto flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-white hover:text-gray-300">Toko Buku Online</a>
                <div>
                    <ul class="flex space-x-4">
                        @auth
                            <li><a href="{{ route('dashboard') }}" class="text-white hover:text-gray-300">Dashboard</a></li>
                            @if(Auth::user()->role === 'admin')
                                <li><a href="{{ route('admin.dashboard') }}" class="text-white hover:text-gray-300">Admin Panel</a></li>
                            @endif
                            <li><a href="{{ route('keranjang.index') }}" class="text-white hover:text-gray-300">Keranjang</a></li> {{-- Link ke Keranjang --}}
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-white hover:text-gray-300 focus:outline-none">Logout</button>
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}" class="text-white hover:text-gray-300">Login</a></li>
                            <li><a href="{{ route('register') }}" class="text-white hover:text-gray-300">Register</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mx-auto mt-8 p-4 bg-white shadow-lg rounded-lg">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ $buku->judul }}</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Kolom Kiri: Gambar -->
                <div>
                    @if ($buku->gambar)
                        <img src="{{ asset('storage/' . $buku->gambar) }}" alt="{{ $buku->judul }}" class="w-full h-auto object-cover rounded-lg shadow-md">
                    @else
                        <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500 text-xl shadow-md">
                            Tidak Ada Gambar
                        </div>
                    @endif
                </div>

                <!-- Kolom Kanan: Detail Teks & Aksi -->
                <div class="space-y-4">
                    <div>
                        <p class="text-gray-600 font-bold">Penulis:</p>
                        <p class="text-gray-800 text-lg">{{ $buku->penulis }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-bold">ISBN:</p>
                        <p class="text-gray-800 text-lg">{{ $buku->isbn }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-bold">Harga:</p>
                        <p class="text-blue-600 font-semibold text-2xl">Rp{{ number_format($buku->harga, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-bold">Stok:</p>
                        <p class="text-gray-800 text-lg">{{ $buku->stok }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-bold">Kategori:</p>
                        <p class="text-gray-800 text-lg">{{ $buku->kategori->nama ?? 'Tidak Berkategori' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 font-bold">Deskripsi:</p>
                        <p class="text-gray-800 text-base leading-relaxed">{{ $buku->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                    </div>

                    <div class="mt-6 flex flex-wrap items-center space-x-4 space-y-2 md:space-y-0">
                        @auth
                            @if ($buku->stok > 0)
                                <form action="{{ route('keranjang.tambah', $buku->id) }}" method="POST" class="flex items-center space-x-2">
                                    @csrf
                                    <input type="number" name="jumlah" value="1" min="1" max="{{ $buku->stok }}" class="w-20 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                                        Tambahkan ke Keranjang
                                    </button>
                                </form>
                            @else
                                <span class="text-red-600 font-bold text-lg">Stok Habis</span>
                            @endif
                        @else
                            <p class="text-gray-600">Login untuk menambahkan ke keranjang.</p>
                        @endauth
                        <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Kembali ke Daftar Buku
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <footer class="mt-8 text-center text-gray-600 text-sm p-4 bg-white shadow-inner">
            © {{ date('Y') }} Toko Buku Online. Hak Cipta Dilindungi.
        </footer>
    </body>
    </html>
    