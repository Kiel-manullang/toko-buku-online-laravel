    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Toko Buku Online</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Inter', sans-serif;
                background: linear-gradient(to right bottom, #87CEEB, #2C5282); /* Gradient biru muda ke biru tua */
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .card {
                backdrop-filter: blur(10px); /* Efek blur untuk semitransparan */
                background-color: rgba(255, 255, 255, 0.85); /* Sedikit transparan */
                border: 1px solid rgba(255, 255, 255, 0.3);
                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            }
            input[type="email"],
            input[type="password"] {
                border-color: #CBD5E0; /* gray-300 */
            }
            input[type="email"]:focus,
            input[type="password"]:focus {
                border-color: #4299E1; /* blue-400 */
                box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5); /* blue-400 with opacity */
            }
            .btn-primary {
                background-color: #3B82F6; /* blue-500 */
            }
            .btn-primary:hover {
                background-color: #2563EB; /* blue-600 */
            }
        </style>
    </head>
    <body class="flex items-center justify-center min-h-screen">

        <div class="w-full max-w-md mx-auto p-6 md:p-8 card rounded-xl transform transition-all duration-300 hover:scale-105">
            <h1 class="text-4xl font-extrabold text-gray-800 text-center mb-8">Login</h1>

            <!-- Pesan Error -->
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                           class="mt-1 block w-full px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 transition duration-200 ease-in-out text-gray-800 placeholder-gray-400"
                           placeholder="your.email@example.com">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" required autocomplete="current-password"
                           class="mt-1 block w-full px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 transition duration-200 ease-in-out text-gray-800 placeholder-gray-400"
                           placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-900">
                            Ingat Saya
                        </label>
                    </div>
                    {{-- Opsional: Tambahkan fitur lupa password jika ada rutenya --}}
                    {{-- <a href="#" class="font-medium text-blue-600 hover:text-blue-500 text-sm">
                        Lupa Password?
                    </a> --}}
                </div>

                <div class="flex flex-col sm:flex-row sm:justify-between items-center space-y-4 sm:space-y-0">
                    <button type="submit" class="w-full sm:w-auto px-6 py-3 border border-transparent text-base font-bold rounded-lg shadow-sm text-white btn-primary hover:scale-105 transform transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Login
                    </button>
                    <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500 text-base py-2 px-4 rounded-lg transition duration-200 ease-in-out">
                        Belum punya akun? Daftar
                    </a>
                </div>
            </form>
        </div>

    </body>
    </html>
    