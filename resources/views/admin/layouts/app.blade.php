<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel Toko Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; /* Default light gray background untuk body */

            /* --- OPSI BACKGROUND IMAGE KUSTOM (UNCOMMENT DAN SESUAIKAN) --- */
            /* Jika Anda ingin menggunakan gambar sebagai background utama panel admin: */
            /*
            background-image: url('{{ asset('images/nama_gambar_anda.jpg') }}'); /* GANTI 'nama_gambar_anda.jpg' DENGAN NAMA FILE ANDA */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;

            /* Opsional: Tambahkan overlay gelap di atas gambar untuk keterbacaan teks yang lebih baik. */
            /* Sesuaikan opacity (0.0 - 1.0) di sini. Misalnya, 0.5 = 50% gelap. */
            background-color: rgba(0, 0, 0, 0.5); /* Warna overlay hitam transparan */
            background-blend-mode: overlay;
            */
        }
        h1, h2 {
            font-family: 'Playfair Display', serif; /* Font mewah untuk judul */
        }
        .sidebar {
            width: 280px; /* Lebar sidebar lebih elegan */
            min-height: 100vh;
            background: linear-gradient(to bottom, #1a202c, #2d3748); /* Gradient dark gray */
            color: #e2e8f0; /* Light text color */
            transition: transform 0.3s ease-in-out, width 0.3s ease-in-out;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 20;
            box-shadow: 4px 0 15px rgba(0,0,0,0.3); /* Shadow yang lebih dalam */
            overflow-y: auto; /* Agar sidebar bisa di-scroll jika isinya panjang */
        }
        .sidebar-header {
            padding: 2.5rem 1.5rem; /* Padding lebih besar */
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 1.25rem 2rem; /* Padding lebih besar */
            border-radius: 0.75rem; /* Rounded corners lebih besar */
            margin: 0.75rem 1.25rem; /* Margin lebih besar */
            transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out, transform 0.2s ease-in-out;
            white-space: nowrap; /* Mencegah teks melipat */
        }
        .sidebar-link:hover {
            background-color: #3B82F6; /* blue-500 for hover */
            color: white;
            transform: translateX(5px); /* Efek slide ringan */
        }
        .sidebar-link.active {
            background: linear-gradient(to right, #3B82F6, #2563EB); /* Gradient biru untuk active */
            color: white;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4); /* Shadow biru */
        }
        .sidebar-link svg {
            margin-right: 1rem;
            width: 22px; /* Ikon lebih besar */
            height: 22px;
        }
        .content-area {
            margin-left: 280px; /* Sesuaikan dengan lebar sidebar baru */
            padding: 2rem; /* Padding konten */
            transition: margin-left 0.3s ease-in-out;
            background-color: #ffffff; /* Background putih bersih untuk area konten */
            min-height: 100vh; /* Pastikan konten setinggi viewport */
            border-top-left-radius: 1rem; /* Rounded top-left corner */
            border-bottom-left-radius: 1rem; /* Rounded bottom-left corner */
            box-shadow: -4px 0 15px rgba(0,0,0,0.1); /* Shadow di sisi kiri */
            flex-grow: 1; /* Pastikan mengambil sisa ruang */
            display: flex; /* Untuk flexbox layout main content */
            flex-direction: column; /* Konten utama diatur secara kolom */
        }
        .navbar-admin {
            background-color: #ffffff; /* Navbar putih atau sesuai background konten */
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 0.75rem; /* Mengurangi ke 0.75rem agar konsisten dengan link */
            padding: 1.5rem 2rem; /* Padding lebih besar */
            margin-bottom: 2rem; /* Jarak antara navbar dan konten */
        }

        /* Status Badges (added for admin panel consistency) */
        .status-pending { background-color: #fbd38d; color: #975a16; } /* yellow-300 / yellow-800 */
        .status-diproses { background-color: #a7f3d0; color: #065f46; } /* green-200 / green-800 */
        .status-dikirim { background-color: #90cdf4; color: #2c5282; } /* blue-300 / blue-800 */
        .status-selesai { background-color: #c6f6d5; color: #2f855a; } /* green-100 / green-700 */
        .status-dibatalkan { background-color: #fed7d7; color: #9b2c2c; } /* red-200 / red-800 */

        /* Responsive adjustments for smaller screens */
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                transform: translateX(-100%);
                box-shadow: none;
                /* Tambahkan full height dan overlay di mobile */
                height: 100%;
                top: 0;
                left: 0;
                position: fixed;
            }
            .sidebar.open { /* This is the class applied by JS */
                width: 280px;
                transform: translateX(0);
                box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            }
            .content-area {
                margin-left: 0; /* Tetap 0 untuk mobile, sidebar akan overlay */
                padding: 1.5rem; /* Padding sedikit lebih kecil untuk mobile */
                border-radius: 0; /* No border-radius on small screen for full width */
                box-shadow: none;
            }
            .navbar-admin {
                padding-left: 1rem;
                padding-right: 1rem;
                border-radius: 0;
            }
            .navbar-admin h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body class="flex"> {{-- Menggunakan flexbox untuk layout utama --}}

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar">
        <div class="sidebar-header">
            <h1 class="text-4xl font-extrabold text-white tracking-wide">Bookify Admin</h1>
        </div>
        <nav class="mt-8">
            <ul>
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m0 0l7 7 7 7M19 10v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.bukus.index') }}" class="sidebar-link {{ request()->routeIs('admin.bukus.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.409 9.333 5 8 5c-4 0-4 10-4 10s1 0 1 0h.463c.563-1.574 1.257-2.946 2.057-4.004v-2.316a1.25 1.25 0 011.25-1.25h1.5a1.25 1.25 0 011.25 1.25v2.316c.8.064 1.494.39 2.057.946H20c1 0 1-2 1-2s0-4-4-4-4-10-4-10z"></path></svg>
                        Manajemen Buku
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kategoris.index') }}" class="sidebar-link {{ request()->routeIs('admin.kategoris.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7m-4 0v10m-6 0V7m-6 0V7m-2 0h18M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        Manajemen Kategori
                    </a>
                </li>
                <li>
                    {{-- LINK INI SUDAH DIAKTIFKAN DAN DIARAHKAN KE RUTE PESANAN ADMIN --}}
                    <a href="{{ route('admin.pesanans.index') }}" class="sidebar-link {{ request()->routeIs('admin.pesanans.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        Manajemen Pesanan
                    </a>
                </li>
                <li>
                    {{-- BARIS BARU INI UNTUK MANAJEMEN PENGGUNA --}}
                    <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h-5m-10 0h10m-1 4v-4m1 0h-5.013a2 2 0 01-1.934-1.294m1.934 1.294A2 2 0 009 19.405V15a2 2 0 012-2h2a2 2 0 012 2v4.405c0 .593.197 1.144.546 1.624m-7.465 1.258a.5.5 0 01-.482.805H11a.5.5 0 01-.482-.805L9 20H5.972c-.524 0-1.026-.208-1.397-.579A1.996 1.996 0 014 18.005V7a2 2 0 012-2h12a2 2 0 012 2v11.005c0 .524-.208 1.026-.579 1.397a1.996 1.996 0 01-1.397.579H15z"></path></svg>
                        Manajemen Pengguna
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content Area -->
    <div id="content-area" class="content-area">
        <!-- Admin Navbar Header -->
        <header class="navbar-admin mb-8 flex justify-between items-center">
            <!-- Hamburger Menu for Mobile -->
            <button id="sidebarToggle" class="md:hidden text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>

            <div class="flex items-center space-x-4 ml-auto">
                <span class="text-gray-700">Selamat Datang, <span class="font-semibold text-blue-600">{{ Auth::user()->name }}</span></span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-5 rounded-lg shadow-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- Page Content from other Blade files -->
        <main class="flex-grow"> {{-- flex-grow agar main mengambil sisa ruang --}}
            @yield('content')
        </main>

        {{-- FOOTER DIKEMBALIKAN KE SINI --}}
        <footer class="mt-8 text-center text-gray-600 text-sm p-4 bg-gray-50 rounded-lg shadow-inner">
            © {{ date('Y') }} Bookify Admin Panel. Hak Cipta Dilindungi.
        </footer>
    </div>

    <script>
        // JavaScript untuk toggle sidebar di mobile
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const contentArea = document.getElementById('content-area');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            // Untuk mobile, sidebar fixed akan overlay, jadi contentArea margin-left tetap 0
        });

        // Close sidebar if clicking outside on mobile
        document.addEventListener('click', (event) => {
            // Periksa apakah lebar layar <= 768px (mobile view)
            // Dan sidebar dalam keadaan terbuka
            // Dan klik tidak berasal dari sidebar itu sendiri atau tombol togglenya
            if (window.innerWidth <= 768 && sidebar.classList.contains('open') &&
                !sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                sidebar.classList.remove('open');
            }
        });

        // Adjust margin for content area on resize (desktop vs mobile)
        function handleResize() {
            if (window.innerWidth > 768) {
                // Desktop: Sidebar selalu terbuka dan contentArea memiliki margin
                sidebar.classList.remove('open'); // Pastikan kelas 'open' dihapus di desktop
                sidebar.style.width = '280px';
                sidebar.style.transform = 'translateX(0)';
                contentArea.style.marginLeft = '280px';
            } else {
                // Mobile: Sidebar tersembunyi secara default, contentArea margin 0
                sidebar.style.width = '0';
                sidebar.style.transform = 'translateX(-100%)';
                contentArea.style.marginLeft = '0';
                // Jika user me-resize dari desktop ke mobile dan sidebar terbuka, sembunyikan
                if (sidebar.classList.contains('open')) {
                    sidebar.classList.remove('open');
                }
            }
        }

        // Jalankan saat load dan resize
        window.addEventListener('load', handleResize);
        window.addEventListener('resize', handleResize);

        // Initial DOMContentLoaded check (same as load for initial setup)
        document.addEventListener('DOMContentLoaded', handleResize);
    </script>
</body>
</html>
