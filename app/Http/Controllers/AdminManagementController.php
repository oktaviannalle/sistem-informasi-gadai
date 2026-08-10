<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminManagementController extends Controller
{
    public function index()
    {
        $admins = User::latest()->paginate(10);

        return view('admin-management.index', compact('admins'));
    }

    public function create()
    {
        return view('admin-management.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin-management.index')->with('success', 'Admin/Petugas baru berhasil ditambahkan.');
    }

    public function edit(User $admin_management)
    {
        $admin = $admin_management;
        return view('admin-management.edit', compact('admin'));
    }

    public function update(Request $request, User $admin_management)
    {
        $admin = $admin_management;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$admin->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->route('admin-management.index')->with('success', 'Data admin berhasil diperbarui.');
    }

    public function destroy(User $admin_management)
    {
        $admin = $admin_management;

        // Proteksi: cegah admin menghapus akunnya sendiri yang sedang aktif
        if (auth()->id() === $admin->id) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang digunakan.');
        }

        $admin->delete();

        return redirect()->route('admin-management.index')->with('success', 'Akun admin berhasil dihapus.');
    }
}
