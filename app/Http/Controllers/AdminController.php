<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Menampilkan dashboard admin
    public function index()
    {
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }

    // Menampilkan daftar pengguna
    public function users()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Menampilkan formulir untuk membuat pengguna baru
    public function create()
    {
        return view('admin.users.create');
    }

    // Menyimpan pengguna baru setelah memeriksa batas maksimum
    public function store(Request $request)
    {
        // Tentukan batas maksimum pengguna
        $maxUsers = 4;
        $currentUserCount = User::count();

        // Periksa jika jumlah pengguna sudah mencapai batas maksimum
        if ($currentUserCount >= $maxUsers) {
            return redirect()->route('admin.users.create')
                             ->with('error', 'User limit reached. Cannot create more users.');
        }

        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,user',
        ]);

        // Membuat pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    // Menampilkan formulir untuk mengedit pengguna
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Memperbarui pengguna
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|in:admin,user',
        ]);

        // Update data pengguna
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        // Update password jika diisi
        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    // Menghapus pengguna
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    // Menampilkan riwayat
    public function logHistory()
    {
        $histories = History::with('user')->paginate(10); // Menggunakan paginate() untuk pagination
        return view('admin.history', compact('histories'));
    }
}
