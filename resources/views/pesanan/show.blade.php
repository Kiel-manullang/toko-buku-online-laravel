<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Detail Pesanan #{{ $pesanan->id }} - BookSphere</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- TailwindCSS CDN -->
<script src="https://cdn.tailwindcss.com"></script>
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
html, body {
    height:100%; 
}
body {
    display:flex;
    flex-direction:column;
    font-family:'Inter',sans-serif;
    /* Animasi Gradien Elegan */
    background: linear-gradient(-45deg, #3b3f5c, #1f2937, #2d3748, #4a5568);
    background-size: 400% 400%; 
    animation: gradientBG 15s ease infinite;
    color:#e5e7eb;
}
@keyframes gradientBG {
    0% { background-position:0% 50%; }
    50% { background-position:100% 50%; }
    100% { background-position:0% 50%; }
}
main { flex-grow:1; }

h1, h2, h3 {
    font-family:'Playfair Display', serif;
    color:#f9fafb;
}
.main-navbar {
    background-color:rgba(31,41,55,0.95);
    backdrop-filter:blur(4px);
    box-shadow:0px 4px 12px rgba(0,0,0,0.3);
}
.nav-link {
    font-weight:500;
    color:#f9fafb;
    transition:color 0.2s ease-in-out;
}
.nav-link:hover { color:#90cdf4; }

/* Main Content Styling */
.main-content-container {
    background-color:rgba(255,255,255,0.95);
    backdrop-filter:blur(8px);
    border-radius:1.5rem;
    box-shadow:0px 8px 25px rgba(0,0,0,0.25);
    padding:2.5rem;
    color:#374151;
}
.order-details-card {
    background-color:#f9fafb;
    border-radius:1rem;
    box-shadow:0px 4px 12px rgba(0,0,0,0.08);
    padding:2rem;
}
.order-summary-item {
    border-bottom:1px dashed #e2e8f0;
    padding-bottom:0.75rem;
    margin-bottom:0.75rem;
}
.order-summary-item:last-child {
    border-bottom:none;
    padding-bottom:0;
    margin-bottom:0;
}
table {
    border-collapse:separate;
    border-spacing:0 0.5rem;
}
th, td {
    padding:1rem 1.5rem;
}
thead th {
    background-color:#4b5563;
    color:#f9fafb;
    text-transform:uppercase;
    font-weight:600;
    font-size:0.85rem;
}
tbody tr {
    background-color:#f9fafb;
    border-radius:0.75rem;
    box-shadow:0px 2px 8px rgba(0,0,0,0.05);
    transition:all 0.15s ease-in-out;
}
tbody tr:hover {
    transform:translateY(-2px);
    box-shadow:0px 4px 12px rgba(0,0,0,0.1);
}
thead tr:first-child th:first-child {border-top-left-radius:1rem;}
thead tr:first-child th:last-child {border-top-right-radius:1rem;}
tbody tr:last-child td:first-child {border-bottom-left-radius:1rem;}
tbody tr:last-child td:last-child {border-bottom-right-radius:1rem;}
.status-pending {background-color:#fbd38d;color:#975a16;}
.status-diproses {background-color:#a7f3d0;color:#065f46;}
.status-dikirim {background-color:#90cdf4;color:#2c5282;}
.status-selesai {background-color:#c6f6d5;color:#2f855a;}
.status-dibatalkan {background-color:#fed7d7;color:#9b2c2c;}
.btn-back-to-orders {
    background-color:#e5e7eb;
    color:#374151;
    border-radius:0.75rem;
    padding:0.75rem 1.5rem;
    font-weight:600;
    transition:all 0.2s ease-in-out;
}
.btn-back-to-orders:hover {
    background-color:#d1d5db;
    transform:scale(1.02);
}
.item-image {
    border-radius:0.5rem;
    box-shadow:0px 2px 5px rgba(0,0,0,0.1);
}
.footer-section {
    background-color:rgba(31,41,55,0.95);
    backdrop-filter:blur(4px);
    color:#d1d5db;
    box-shadow:0px -4px 12px rgba(0,0,0,0.3);
}
.footer-section h4 {
    color:#e5e7eb;
}
.footer-link:hover {
    color:#90cdf4;
}
.footer-bottom-text {
    color:#9ca3af;
}
</style>
</head>
<body>

<!-- Navbar -->
<nav class="main-navbar p-4 text-white">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-xl font-extrabold text-white tracking-wider">BookSphere</a>
        <div class="flex items-center space-x-6">
            <div class="text-sm font-medium" id="live-clock"></div>
            <ul class="flex space-x-4">
                @auth
                    <li><a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a></li>
                    @if(Auth::user()->role === 'admin')
                        <li><a href="{{ route('admin.dashboard') }}" class="nav-link">Admin Panel</a></li>
                    @endif
                    <li><a href="{{ route('keranjang.index') }}" class="nav-link">Keranjang</a></li>
                    <li><a href="{{ route('pesanan.index') }}" class="nav-link">Pesanan Saya</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
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

<!-- Main -->
<main class="container mx-auto mt-10 p-4">
    <h1 class="text-3xl font-bold text-center mb-8">Detail Pesanan #{{ $pesanan->id }}</h1>
    <div class="main-content-container">
        <div class="order-details-card">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="space-y-4">
                    <div class="order-summary-item">
                        <p class="text-gray-600 font-medium text-sm">Tanggal Pesanan:</p>
                        <p class="text-gray-800 text-base">{{ $pesanan->created_at->format('d M Y H:i:s') }}</p>
                    </div>
                    <div class="order-summary-item">
                        <p class="text-gray-600 font-medium text-sm">Status:</p>
                        <span class="px-3 py-1 rounded-full text-sm font-semibold uppercase status-{{ $pesanan->status }}">
                            {{ $pesanan->status }}
                        </span>
                    </div>
                    <div class="order-summary-item">
                        <p class="text-gray-600 font-medium text-sm">Total Pembayaran:</p>
                        <p class="text-indigo-700 font-bold text-xl">Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="order-summary-item">
                        <p class="text-gray-600 font-medium text-sm">Nama Pembeli:</p>
                        <p class="text-gray-800 text-base">{{ $pesanan->user->name }}</p>
                    </div>
                    <div class="order-summary-item">
                        <p class="text-gray-600 font-medium text-sm">Email Pembeli:</p>
                        <p class="text-gray-800 text-base">{{ $pesanan->user->email }}</p>
                    </div>
                </div>
            </div>

            <h2 class="text-2xl font-bold text-gray-800 mb-6">Item Pesanan</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="text-left rounded-tl-xl">Buku</th>
                            <th class="text-right">Harga Satuan (Saat Pesan)</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-right rounded-tr-xl">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanan->pesananItems as $item)
                        <tr>
                            <td class="flex items-center space-x-3">
                                @if ($item->buku->gambar)
                                    <img src="{{ asset('storage/' . $item->buku->gambar) }}" alt="{{ $item->buku->judul }}" class="w-16 h-16 object-cover item-image">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 item-image flex items-center justify-center text-gray-500 text-xs">No Image</div>
                                @endif
                                <div>
                                    <a href="{{ route('bukus.show', $item->buku->id) }}" class="font-bold text-indigo-600 hover:underline text-base">{{ $item->buku->judul }}</a>
                                    <p class="text-gray-500 text-xs">Oleh: {{ $item->buku->penulis }}</p>
                                </div>
                            </td>
                            <td class="text-right text-base">Rp{{ number_format($item->harga_saat_pesan, 0, ',', '.') }}</td>
                            <td class="text-center text-base font-medium">{{ $item->jumlah }}</td>
                            <td class="text-right font-semibold text-lg">Rp{{ number_format($item->jumlah * $item->harga_saat_pesan, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-100 font-bold text-lg">
                            <td colspan="3" class="py-4 px-6 text-right">Total Keseluruhan Pesanan:</td>
                            <td class="py-4 px-6 text-right text-indigo-700">Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
        <div class="mt-8 flex justify-end">
            <a href="{{ route('pesanan.index') }}" class="btn-back-to-orders inline-flex items-center">
                &larr; Kembali ke Riwayat Pesanan
            </a>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="footer-section text-center mt-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <div>
                <h4 class="text-xl font-extrabold text-white mb-4">BookSphere</h4>
                <p class="text-sm leading-relaxed text-gray-400">Destinasi utama untuk buku premium dan pengetahuan tak terbatas.</p>
            </div>
            <div>
                <h4 class="text-lg font-bold text-white mb-4">Tautan Cepat</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="footer-link text-gray-400 hover:text-white text-sm">Beranda</a></li>
                    @auth
                        <li><a href="{{ route('dashboard') }}" class="footer-link text-gray-400 hover:text-white text-sm">Dashboard</a></li>
                        <li><a href="{{ route('keranjang.index') }}" class="footer-link text-gray-400 hover:text-white text-sm">Keranjang Saya</a></li>
                        <li><a href="{{ route('pesanan.index') }}" class="footer-link text-gray-400 hover:text-white text-sm">Pesanan Saya</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="footer-link text-gray-400 hover:text-white text-sm">Login</a></li>
                        <li><a href="{{ route('register') }}" class="footer-link text-gray-400 hover:text-white text-sm">Register</a></li>
                    @endauth
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <li><a href="{{ route('admin.dashboard') }}" class="footer-link text-gray-400 hover:text-white text-sm">Admin Panel</a></li>
                    @endif
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-bold text-white mb-4">Kontak Kami</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li>Email: support@booksphere.com</li>
                    <li>Telepon: +62 123 4567 890</li>
                    <li>Alamat: Jl. Contoh No. 123, Jakarta, Indonesia</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-700 pt-6 text-center">
            <p class="text-xs footer-bottom-text">© {{ date('Y') }} BookSphere. Hak Cipta Dilindungi.</p>
            <p class="text-xs mt-1 footer-bottom-text">Desain & Pengembangan oleh Gemini AI.</p>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script>
function updateClock() {
    const now = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour:'2-digit', minute:'2-digit', second:'2-digit' };
    const formattedDateTime = now.toLocaleDateString('id-ID', options);
    document.getElementById('live-clock').textContent = formattedDateTime;
}
setInterval(updateClock, 1000);
updateClock();
</script>

</body>
</html>
