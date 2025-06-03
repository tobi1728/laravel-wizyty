<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AdminProfileController extends Controller
{
    public function edit()
    {
        $admin = Auth::user()->admin;

        return view('admin.profile', compact('admin'));
    }


    /**
     *  Aktualizacja profilu administratora.
     */
    public function updateAdmin(Request $request): RedirectResponse
    {
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
        ]);

        $user = $request->user();

        // Sprawdzenie czy e-mail się zmienił – wtedy resetujemy weryfikację
        if ($user->email !== $request->email) {
            $user->email_verified_at = null;
        }

        $user->update([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Dane zostały zaktualizowane.');
    }

    /**
     * Usunięcie konta użytkownika.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
