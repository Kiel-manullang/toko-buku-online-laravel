    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Riwayat Pesanan - Toko Buku Online</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <style>
            .status-pending { background-color: #fbd38d; color: #975a16; } /* yellow-300 / yellow-800 */
            .status-diproses { background-color: #a7f3d0; color: #065f46; } /* green-200 / green-800 */
            .status-dikirim { background-color: #90cdf4; color: #2c5282; } /* blue-300 / blue-800 */
            .status-selesai { background-color: #c6f6d5; color: #2f855a; } /* green-100 / green-700 */
            .status-dibatalkan { background-color: #fed7d7; color: #9b2c2c; } /* red-200 / red-800 */
        </style>
    </head>
    <body class="bg-gray-100 font-sans leading-normal tracking-normal">

        <!-- Navbar Public (Sama seperti welcome.blade.php) -->
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
                            <li><a href="{{ route('keranjang.index') }}" class="text-white hover:text-gray-300">Keranjang</a></li>
                            <li><a href="{{ route('pesanan.index') }}" class="text-white hover:text-gray-300">Pesanan Saya</a></li> {{-- Link ke Riwayat Pesanan --}}
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

        <div class="container mx-auto mt-8 p-4">
            <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">Riwayat Pesanan Saya</h1>

            <!-- Pesan Sukses/Error -->
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-md" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-md" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @if ($pesanans->isEmpty())
                <div class="bg-white p-6 rounded-lg shadow-md text-center text-gray-600">
                    Anda belum memiliki riwayat pesanan. Yuk, <a href="{{ route('home') }}" class="text-blue-600 hover:underline">mulai belanja</a>!
                </div>
            @else
                <div class="space-y-6">
                    @foreach ($pesanans as $pesanan)
                        <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-blue-500">
                            <div class="flex justify-between items-center mb-4 border-b pb-3">
                                <div>
                                    <h2 class="text-xl font-bold text-gray-800">Pesanan #{{ $pesanan->id }}</h2>
                                    <p class="text-sm text-gray-600">Tanggal: {{ $pesanan->created_at->format('d M Y H:i') }}</p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold uppercase status-{{ $pesanan->status }}">
                                    {{ $pesanan->status }}
                                </span>
                            </div>

                            <div class="mb-4">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Item Pesanan:</h3>
                                <ul class="list-disc list-inside text-gray-700 space-y-1">
                                    @foreach ($pesanan->pesananItems as $item)
                                        <li>
                                            {{ $item->buku->judul }} ({{ $item->jumlah }}x) - Rp{{ number_format($item->harga_saat_pesan, 0, ',', '.') }} per item
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="flex justify-between items-center border-t pt-3">
                                <span class="text-lg font-bold text-gray-800">Total: Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                                <a href="{{ route('pesanan.show', $pesanan->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8 flex justify-center">
                    {{ $pesanans->links('pagination::tailwind') }}
                </div>
            @endif
        </div>

        <footer class="mt-8 text-center text-gray-600 text-sm p-4 bg-white shadow-inner">
            © {{ date('Y') }} Toko Buku Online. Hak Cipta Dilindungi.
        </footer>
    </body>
    </html>
    