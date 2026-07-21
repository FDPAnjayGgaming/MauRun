<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Tampilkan daftar semua peserta.
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'peserta');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('nik', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->latest()->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Form edit user.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update data user.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'nik'   => ['nullable', 'string', 'size:16', Rule::unique(User::class)->ignore($user->id)],
            'no_hp' => ['nullable', 'numeric', 'digits_between:10,13', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->update($validated);

        return redirect()->route('manage-users.index')->with('success', 'Data user berhasil diperbarui.');
    }

    /**
     * Hapus user.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('manage-users.index')->with('success', 'User berhasil dihapus.');
    }
}
