<?php

namespace App\Http\Controllers;

use App\Models\User; // Import Model User
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna untuk admin.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil semua data pengguna dari database, diurutkan dari yang terbaru
        // Anda bisa menambahkan paginasi jika daftar user sangat banyak
        $users = User::latest()->paginate(10); // Ambil 10 user per halaman

        return view('admin.users.index', compact('users'));
    }

    /**
     * Menampilkan detail pengguna tertentu.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    // Metode untuk 'edit' dan 'update' akan ditambahkan nanti jika diperlukan
    // Metode untuk 'destroy' (menghapus user) juga akan ditambahkan nanti jika diperlukan
}
