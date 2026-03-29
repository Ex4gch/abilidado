<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class EmployerAuthController extends Controller
{
    // Show the registration form
    public function create()
    {
        return view('auth.register-employer');
    }

    // Handle the form submission
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Securely create the user and force the role to 'employer'
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'employer', // <-- Secured on the backend!
        ]);

        // Log the new employer in
        Auth::login($user);

        // Send them straight to their new dashboard
        return redirect('/employer/dashboard');
    }
}