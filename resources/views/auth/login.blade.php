<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Toko Buku Online</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at center, #1e293b 0%, #0f172a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            overflow: hidden;
        }

        /* Background animation */
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 40px 40px;
            animation: moveBackground 30s linear infinite;
            z-index: -1;
        }

        @keyframes moveBackground {
            0% { transform: translate(0, 0); }
            100% { transform: translate(40px, 40px); }
        }

        .card {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 1.5rem;
            padding: 2.5rem 2rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
            width: 100%;
            max-width: 460px;
            transition: all 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.5);
        }

        input[type="email"],
        input[type="password"] {
            border: 1px solid #374151;
            background: rgba(255, 255, 255, 0.05);
            color: #f3f4f6;
        }

        input[type="email"]::placeholder,
        input[type="password"]::placeholder {
            color: #9ca3af;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.4);
        }

        .btn-primary {
            background: linear-gradient(to right, #7c3aed, #6d28d9);
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #6d28d9, #5b21b6);
        }

        label, .text-sm, .text-base {
            color: #e5e7eb;
        }

        .card h1 {
            color: #ffffff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1 class="text-4xl font-bold text-center mb-8">Login</h1>

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md shadow">
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
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                    class="mt-1 block w-full px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 placeholder-gray-500"
                    placeholder="your.email@example.com">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium">Password</label>
                <input type="password" name="password" id="password" required autocomplete="current-password"
                    class="mt-1 block w-full px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 placeholder-gray-500"
                    placeholder="••••••••">
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 text-sm">Ingat Saya</label>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row sm:justify-between items-center gap-4">
                <button type="submit" class="w-full sm:w-auto px-6 py-3 text-base font-bold text-white rounded-lg shadow btn-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    Login
                </button>
                <a href="{{ route('register') }}" class="text-purple-400 hover:text-purple-300 text-base">
                    Belum punya akun? Daftar
                </a>
            </div>
        </form>
    </div>
</body>
</html>
