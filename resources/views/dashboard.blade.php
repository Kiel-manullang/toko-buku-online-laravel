<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard Pengguna - BookSphere</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>
<!-- Particles.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Inter', sans-serif;
    background-color: #111827;
    color: #f9fafb;
    position: relative;
    min-height: 100vh;
}
h1, h2 {
    font-family: 'Playfair Display', serif;
}
.nav-link:hover {
    color: #f472b6;
}
#live-clock {
    font-size: 0.9rem;
    font-weight: 600;
    padding: 0.25rem 1rem;
    background: rgba(255,255,255,0.1);
    border-radius: 1rem;
}
.content-layer {
    position: relative;
    z-index: 1;
    padding-bottom: 100px;
}
.dashboard-card {
    background: rgba(31,41,55,0.95);
    border-radius: 1rem;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    backdrop-filter: blur(10px);
}
.dashboard-card:hover {
    transform: translateY(-3px);
    box-shadow: 0px 8px 24px rgba(244,114,182,0.25);
}
.dashboard-card-btn {
    background: linear-gradient(90deg,#ec4899,#8b5cf6);
    color: #fff;
    border-radius: 0.75rem;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
}
.dashboard-card-btn:hover {
    transform: scale(1.03);
    box-shadow: 0px 4px 15px rgba(236,72,153,0.3);
}
.footer-section {
    position: relative;
    background: linear-gradient(135deg,#1f2937,#111827);
    color: #d1d5db;
}
.footer-link:hover {
    color: #f472b6;
}
.footer-bottom-text {
    color: #9ca3af;
}
</style>
</head>
<body>
<!-- Particles -->
<div id="particles-js" class="absolute inset-0"></div>

<!-- Navbar -->
<nav class="bg-gray-900 p-4 text-white sticky top-0 z-10">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-2xl font-bold">BookSphere</a>
        <div class="flex items-center space-x-4">
            <div id="live-clock"></div>
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
                            <button class="nav-link focus:outline-none">Logout</button>
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

<!-- Main Dashboard -->
<div class="content-layer container mx-auto mt-12 p-4">
    <h1 class="text-3xl font-bold text-center">👋 Selamat Datang, {{ Auth::user()->name }}</h1>
    <p class="text-center text-gray-400 mt-1">Kamu login sebagai <span class="font-semibold">{{ Auth::user()->role }}</span> BookSphere</p>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
        <div class="dashboard-card p-6 border-t-4 border-indigo-500">
            <h2 class="text-xl font-semibold">Total Pesanan</h2>
            <p class="text-3xl font-bold mt-2 text-pink-400">{{ $total_pesanan ?? '0' }}</p>
            <p class="text-gray-500 text-sm">Pesanan yang pernah kamu buat</p>
        </div>
        <div class="dashboard-card p-6 border-t-4 border-green-500">
            <h2 class="text-xl font-semibold">Total Buku</h2>
            <p class="text-3xl font-bold mt-2 text-pink-400">{{ $total_buku ?? '0' }}</p>
            <p class="text-gray-500 text-sm">Buku tersedia untuk dijelajahi</p>
        </div>
        <div class="dashboard-card p-6 border-t-4 border-yellow-500">
            <h2 class="text-xl font-semibold">Items di Keranjang</h2>
            <p class="text-3xl font-bold mt-2 text-pink-400">{{ $count_keranjang ?? '0' }}</p>
            <p class="text-gray-500 text-sm">Item belum di checkout</p>
        </div>
        <div class="dashboard-card p-6 border-t-4 border-pink-500">
            <h2 class="text-xl font-semibold">Wishlist</h2>
            <p class="text-3xl font-bold mt-2 text-pink-400">5</p>
            <p class="text-gray-500 text-sm">Buku yang kamu simpan untuk nanti</p>
        </div>
    </div>

    <!-- Links Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
        <div class="dashboard-card p-6 border-t-4 border-purple-500">
            <h2 class="text-xl font-semibold">Jelajahi Buku</h2>
            <p class="text-gray-400 text-sm">Temukan buku terbaru dan karya klasik untuk koleksimu!</p>
            <a href="{{ route('home') }}" class="dashboard-card-btn mt-3 inline-block">Mulai Jelajahi</a>
        </div>
        <div class="dashboard-card p-6 border-t-4 border-red-500">
            <h2 class="text-xl font-semibold">Lacak Pesanan</h2>
            <p class="text-gray-400 text-sm">Cek status pesananmu yang sedang dikirim atau diproses!</p>
            <a href="{{ route('pesanan.index') }}" class="dashboard-card-btn mt-3 inline-block">Lacak Sekarang</a>
        </div>
        <div class="dashboard-card p-6 border-t-4 border-teal-500">
            <h2 class="text-xl font-semibold">Keranjang Belanja</h2>
            <p class="text-gray-400 text-sm">Periksa dan selesaikan pembelian dari keranjangmu!</p>
            <a href="{{ route('keranjang.index') }}" class="dashboard-card-btn mt-3 inline-block">Lihat Keranjang</a>
        </div>
    </div>

    <!-- User Info Section -->
    <div class="mt-10 p-6 rounded-lg border border-gray-700 bg-gray-800">
        <h2 class="text-2xl font-semibold text-gray-100">Informasi Akun</h2>
        <p class="text-gray-300 mt-3">👤 Nama: <span class="font-medium text-white">{{ Auth::user()->name }}</span></p>
        <p class="text-gray-300 mt-1">✉️ Email: <span class="font-medium text-white">{{ Auth::user()->email }}</span></p>
    </div>
</div>

<!-- Footer -->
<footer class="footer-section mt-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 py-8">
            <div>
                <h4 class="text-xl font-bold text-white">BookSphere</h4>
                <p class="text-sm mt-2 text-gray-400">Destinasi utama untuk pengetahuan tak terbatas dan pengalaman membaca premium.</p>
            </div>
            <div>
                <h4 class="text-lg font-bold text-white">Tautan Cepat</h4>
                <ul class="space-y-2 mt-2">
                    <li><a href="{{ route('home') }}" class="footer-link text-gray-400 text-sm">Beranda</a></li>
                    <li><a href="{{ route('dashboard') }}" class="footer-link text-gray-400 text-sm">Dashboard</a></li>
                    <li><a href="{{ route('keranjang.index') }}" class="footer-link text-gray-400 text-sm">Keranjang</a></li>
                    <li><a href="{{ route('pesanan.index') }}" class="footer-link text-gray-400 text-sm">Pesanan</a></li>
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <li><a href="{{ route('admin.dashboard') }}" class="footer-link text-gray-400 text-sm">Admin Panel</a></li>
                    @endif
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-bold text-white">Kontak Kami</h4>
                <ul class="space-y-2 text-gray-400 text-sm mt-2">
                    <li>Email: support@booksphere.com</li>
                    <li>Telepon: +62 123 4567 890</li>
                    <li>Alamat: Jl. Contoh No. 123, Jakarta</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-700 pt-4 text-center">
            <p class="text-xs footer-bottom-text">© {{ date('Y') }} BookSphere. Hak Cipta Dilindungi.</p>
            <p class="text-xs mt-1 footer-bottom-text">Desain & Pengembangan oleh Tim BookSphere</p>
        </div>
    </div>
</footer>

<!-- Scripts -->
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
    document.getElementById('live-clock').textContent = now.toLocaleDateString('id-ID', options);
}
setInterval(updateClock, 1000);
updateClock();

// Particles.js
particlesJS("particles-js", {
  "particles": {
    "number": {"value":100,"density":{"enable":true,"value_area":800}},
    "color":{"value":"#ec4899"},
    "shape":{"type":"circle"},
    "opacity":{"value":0.5,"random":false},
    "size":{"value":3,"random":true},
    "line_linked":{"enable":false},
    "move":{"enable":true,"speed":1,"direction":"none","out_mode":"out"}
  }
});
</script>
</body>
</html>
