<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Device;
use Illuminate\Support\Facades\Password;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'created_at')->get();

        return view('user_management', compact('users'));
    }

    public function create()
    {
        return view('create_user');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:strict', 'max:255', 'unique:users'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make(Str::random(16)),
        ]);

        try {
            $response = Password::sendResetLink(['email' => $user->email]);

            if ($response !== Password::RESET_LINK_SENT) {
                throw new \RuntimeException($response);
            }
        } catch (\Throwable $e) {
            $user->delete();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Fehler beim Versenden der Benachrichtigungs-E-Mail.');
        }

        return redirect()->route('user-management.index')->with('success', 'Benutzer wurde erstellt.');
    }

    public function destroy(User $user)
    {
        if ($user->id === 1) {
            return redirect()->route('user-management.index')->with('error', 'Der Admin-Account kann nicht gel\u00f6scht werden.');
        }

        Device::where('last_edit_by', $user->id)->update(['last_edit_by' => 1]);

        $user->delete();

        return redirect()->route('user-management.index')->with('success', 'Benutzer wurde gel\u00f6scht.');
    }
}
