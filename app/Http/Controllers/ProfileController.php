<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'current_password' => 'nullable|required_with:password',
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, auth()->user()->password)) {
                return redirect()->back()
                    ->withErrors(['current_password' => 'Password saat ini salah.']);
            }
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        auth()->user()->update($validated);

        return redirect()->route('profile.show')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}
