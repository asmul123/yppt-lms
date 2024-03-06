<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class AllUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user', [
            'menu' => 'referensi',
            'smenu' => 'user',
            'users' => User::all(),
            'roles' => Role::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required', 'unique:username',
            'password' => 'required',
            'role_id' => 'required'
        ]);

        $existingUser = User::where('username', $validated['username'])->first();

        if ($existingUser) {
            return redirect()->back()->with('failed', 'Gagal, Nama pengguna sudah ada');
        }

        if ($validated['password'] !== $request->password_confirmation) {
            return redirect()->back()->with('failed', 'Gagal, Konfirmasi Kata Sandi tidak sesuai');
        } else {
            User::create($validated);
            return redirect()->back()->with('success', 'User berhasil disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect()->back()->with('success', 'User berhasil dihapus');
    }
}
