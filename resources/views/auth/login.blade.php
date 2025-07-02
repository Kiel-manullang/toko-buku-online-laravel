<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Toko Buku Online</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    @keyframes gradientBG {
      0% {
        background-position: 0% 50%;
      }
      50% {
        background-position: 100% 50%;
      }
      100% {
        background-position: 0% 50%;
      }
    }

    .card {
      backdrop-filter: blur(25px);
      background: rgba(255, 255, 255, 0.2);
      border: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: 1.5rem;
      box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
    }

    .card h1 {
      font-family: 'Playfair Display', serif;
      text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }

    input[type="email"],
    input[type="password"] {
      background: rgba(255, 255, 255, 0.3);
      border: none;
      color: #fff;
    }

    input[type="email"]::placeholder,
    input[type="password"]::placeholder {
      color: #f1f5f9;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
      background: rgba(255, 255, 255, 0.5);
      outline: none;
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.4);
    }

    label {
      color: #f1f5f9;
    }

    .btn-primary {
      background: linear-gradient(135deg, #7e5bef, #fb7ba2);
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background: linear-gradient(135deg, #5b3ee5, #f75b93);
      transform: translateY(-3px) scale(1.02);
      box-shadow: 0 8px 20px rgba(124, 58, 237, 0.4);
    }

    a {
      transition: color 0.3s ease;
    }

    a:hover {
      color: #fff;
    }
  </style>
</head>
<body class="flex items-center justify-center min-h-screen">

  <div class="w-full max-w-md mx-auto p-8 card rounded-2xl">
    <h1 class="text-4xl font-extrabold text-white text-center mb-8">Login</h1>

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
        <label for="email" class="block text-sm font-medium mb-1">Email Address</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus
          class="mt-1 block w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 transition duration-200 ease-in-out placeholder-white"
          placeholder="your.email@example.com" />
      </div>

      <div>
        <label for="password" class="block text-sm font-medium mb-1">Password</label>
        <input type="password" name="password" id="password" required autocomplete="current-password"
          class="mt-1 block w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 transition duration-200 ease-in-out placeholder-white"
          placeholder="••••••••" />
      </div>

      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <input type="checkbox" name="remember" id="remember"
            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" />
          <label for="remember" class="ml-2 block text-sm text-gray-100">
            Ingat Saya
          </label>
        </div>
      </div>

      <div class="flex flex-col sm:flex-row sm:justify-between items-center space-y-4 sm:space-y-0">
        <button type="submit"
          class="w-full sm:w-auto px-8 py-3 text-base font-bold rounded-lg text-white btn-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          Login
        </button>
        <a href="{{ route('register') }}"
          class="font-medium text-indigo-100 text-base py-2 px-4 rounded-lg">
          Belum punya akun? Daftar
        </a>
      </div>
    </form>
  </div>

</body>
</html>
