<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Penting: import Auth facade

class RegisterController extends Controller
{
    // Menampilkan form registrasi
    public function showRegistrationForm()
    {
        return view('auth.register'); // Kita akan membuat view ini nanti
    }

    // Memproses data registrasi
    public function register(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // 2. Buat User Baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role untuk setiap user baru adalah 'user'
        ]);

        // 3. Login User Secara Otomatis Setelah Registrasi
        Auth::login($user);

        // 4. Redirect ke Dashboard atau Halaman Lain
        return redirect('/dashboard')->with('success', 'Registrasi berhasil! Selamat datang!'); // Kita akan membuat route /dashboard nanti
    }
}