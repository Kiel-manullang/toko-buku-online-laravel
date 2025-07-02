<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookSphere - Gerbang Pengetahuan Premium</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #111111, #1c1c1c);
            color: #e5e5e5;
        }
        h1, h2, h3, h4 {
            font-family: 'Playfair Display', serif;
            color: #f5f5f5;
        }
        a {
            text-decoration: none;
        }
        a:hover {
            color: #d4af37;
        }
        /* Navbar */
        .main-navbar {
            background-color: #111;
            box-shadow: 0px 4px 30px rgba(212, 175, 55, 0.25);
        }
        .main-navbar a {
            color: #e5e5e5;
        }
        .main-navbar a:hover {
            color: #d4af37;
        }
        /* Hero */
        .hero-section {
            background: linear-gradient(135deg, #d4af37, #7c6013);
            color: #fff;
            padding: 8rem 0;
            text-align: center;
            border-bottom-left-radius: 100px;
            border-bottom-right-radius: 100px;
        }
        .hero-section h1 {
            font-size: 4rem;
            font-weight: 800;
            text-transform: uppercase;
            text-shadow: 2px 2px 15px rgba(0,0,0,0.5);
        }
        .hero-section p {
            font-size: 1.25rem;
            max-width: 900px;
            margin: auto;
        }
        /* Search Filter */
        .search-filter-card {
            background-color: rgba(30, 30, 30, 0.95);
            backdrop-filter: blur(12px);
            border-radius: 2rem;
            padding: 2rem;
            margin-top: -6rem;
            border: 1px solid rgba(212, 175, 55, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .search-filter-card:hover {
            transform: translateY(-8px);
            box-shadow: 0px 12px 30px rgba(212, 175, 55, 0.25);
        }
        .search-filter-card input,
        .search-filter-card select {
            border-radius: 1rem;
            padding: 0.8rem 1.5rem;
            border: 1px solid #555;
            background-color: #222;
            color: #f5f5f5;
        }
        .search-filter-card button {
            border-radius: 1rem;
            padding: 0.8rem 2rem;
            background: linear-gradient(45deg, #d4af37, #b88d27);
            font-weight: bold;
            color: #111;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .search-filter-card button:hover {
            transform: translateY(-3px);
            box-shadow: 0px 8px 20px rgba(212, 175, 55, 0.3);
        }
        /* Main Content */
        .main-content-wrapper {
            background-color: #1c1c1c;
            border-radius: 2rem;
            box-shadow: 0px 12px 30px rgba(212, 175, 55, 0.1);
            padding: 3rem;
            margin-top: 2rem;
        }
        /* Book Card */
        .book-card {
            transition: all 0.3s ease;
            border-radius: 1.25rem;
            border: 1px solid #333;
            background-color: #222;
            overflow: hidden;
        }
        .book-card:hover {
            transform: translateY(-10px);
            box-shadow: 0px 25px 40px rgba(212, 175, 55, 0.25);
            border-color: #d4af37;
        }
        .book-card h3 {
            font-size: 1.5rem;
            color: #f5f5f5;
        }
        .book-card p {
            color: #aaaaaa;
        }
        .book-card .text-purple-700 {
            font-size: 2rem;
            color: #d4af37;
        }
        .btn-detail {
            background: linear-gradient(45deg, #d4af37, #b88d27);
            font-weight: bold;
            border-radius: 1rem;
            color: #111;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .btn-detail:hover {
            transform: scale(1.03);
            box-shadow: 0px 8px 25px rgba(212, 175, 55, 0.3);
        }
        /* Footer */
        .footer-section {
            background: linear-gradient(135deg, #111, #1c1c1c);
            color: #c9c9c9;
            padding: 5rem 0;
        }
        .footer-section h4 {
            color: #f5f5f5;
        }
        .footer-link:hover {
            color: #d4af37;
            transform: translateX(3px);
        }
        .footer-bottom-text {
            color: #777;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="main-navbar p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold">BookSphere</a>
            <div class="flex items-center space-x-6">
                <div id="live-clock" class="text-sm font-medium"></div>
                <ul class="flex space-x-4">
                    @auth
                        <li><a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a></li>
                        @if(Auth::user()->role === 'admin')
                        <li><a href="{{ route('admin.dashboard') }}" class="nav-link">Admin Panel</a></li>
                        @endif
                        <li><a href="{{ route('keranjang.index') }}" class="nav-link">Keranjang</a></li>
                        <li><a href="{{ route('pesanan.index') }}" class="nav-link">Pesanan</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-link focus:outline-none">Logout</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                        <li><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <h1>Gerbang Pengetahuan Premium</h1>
        <p>Temukan ribuan buku dari berbagai genre dan penulis terbaik, koleksi premium hanya untukmu di BookSphere</p>
    </section>

    <!-- Main Container -->
    <div class="container mx-auto px-4">
        <!-- Search & Filter -->
        <div class="search-filter-card">
            <form action="{{ route('home') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center">
                <input type="text" name="search" placeholder="Cari judul, penulis, atau ISBN..."
                    value="{{ request('search') }}" class="flex-1">
                <select name="kategori">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                    @endforeach
                </select>
                <button type="submit">Cari Buku</button>
                @if(request('search') || request('kategori'))
                    <a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-100 font-medium">Reset</a>
                @endif
            </form>
        </div>

        <h2 class="text-3xl md:text-4xl font-bold text-center mt-12">Koleksi Pilihan BookSphere</h2>

        <!-- Book List -->
        <div class="main-content-wrapper">
            @if ($bukus->isEmpty())
                <div class="p-8 text-center text-gray-500">Maaf, tidak ada buku yang ditemukan.
                    @if(request('search') || request('kategori'))
                        <p class="mt-3 text-sm">Coba kata kunci atau filter lain, atau <a href="{{ route('home') }}" class="text-yellow-500 hover:underline">tampilkan semua buku</a>.</p>
                    @endif
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach ($bukus as $buku)
                        <div class="book-card flex flex-col justify-between">
                            <div>
                                @if ($buku->gambar)
                                    <img src="{{ asset('storage/' . $buku->gambar) }}" alt="{{ $buku->judul }}" class="w-full h-56 object-cover">
                                @else
                                    <div class="w-full h-56 flex items-center justify-center bg-gray-800 text-gray-500">Tidak Ada Gambar</div>
                                @endif
                                <div class="p-4">
                                    <h3>{{ $buku->judul }}</h3>
                                    <p>Penulis: <span class="font-medium">{{ $buku->penulis }}</span></p>
                                    <p>ISBN: {{ $buku->isbn }}</p>
                                    <p class="text-purple-700">Rp{{ number_format($buku->harga, 0, ',', '.') }}</p>
                                    <p>Stok: <span class="font-semibold">{{ $buku->stok }}</span></p>
                                    <p>Kategori: <span class="font-semibold">{{ $buku->kategori->nama ?? 'Tidak Ada' }}</span></p>
                                </div>
                            </div>
                            <div class="p-4">
                                <a href="{{ route('bukus.show', $buku->id) }}" class="btn-detail block text-center py-2">Lihat Detail</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-8 flex justify-center">
                    {{ $bukus->links('pagination::tailwind') }}
                </div>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-section text-center">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h4>BookSphere</h4>
                    <p class="text-sm">Destinasi utama untuk buku-buku premium dan pengetahuan tak terbatas</p>
                </div>
                <div>
                    <h4>Tautan</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="footer-link">Beranda</a></li>
                        @auth
                        <li><a href="{{ route('dashboard') }}" class="footer-link">Dashboard</a></li>
                        <li><a href="{{ route('keranjang.index') }}" class="footer-link">Keranjang</a></li>
                        <li><a href="{{ route('pesanan.index') }}" class="footer-link">Pesanan</a></li>
                        @else
                        <li><a href="{{ route('login') }}" class="footer-link">Login</a></li>
                        <li><a href="{{ route('register') }}" class="footer-link">Register</a></li>
                        @endauth
                        @if(Auth::check() && Auth::user()->role === 'admin')
                        <li><a href="{{ route('admin.dashboard') }}" class="footer-link">Admin Panel</a></li>
                        @endif
                    </ul>
                </div>
                <div>
                    <h4>Kontak</h4>
                    <p>Email: support@booksphere.com</p>
                    <p>Telp: +62 123 4567 890</p>
                    <p>Alamat: Jl. smraja. 123, medan, Indonesia</p>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-6 mt-8">
                <p class="footer-bottom-text">© {{ date('Y') }} BookSphere. Hak Cipta Dilindungi</p>
                <p class="footer-bottom-text text-sm mt-1">Desain & Pengembangan oleh Kelompok 5</p>
            </div>
        </div>
    </footer>

    <!-- Live Clock Script -->
    <script>
        function updateClock() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            const formatted = now.toLocaleDateString('id-ID', options);
            document.getElementById('live-clock').textContent = formatted;
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</body>
</html>
