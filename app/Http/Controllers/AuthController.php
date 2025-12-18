<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Mostrar el formulario de login
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Procesar el login
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'name' => 'required|string',
            'password' => 'required',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Regenerar la sesión para prevenir session fixation
            $request->session()->regenerate();

            return redirect()->route('courses.index')->with('success', 'Bienvenido de vuelta!');
        }

        // Si la autenticación falla
        return back()->withErrors([
            'name' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('name');
    }

    /**
     * Mostrar el formulario de registro
     */
    public function showRegister(): View
    {
        return view('auth.register');
    }

    /**
     * Procesar el registro
     */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Crear el usuario
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['name'],
            'password' => Hash::make($validated['password']),
        ]);

        // Autenticar automáticamente al usuario
        Auth::login($user);

        return redirect()->route('courses.index')->with('success', '¡Cuenta creada exitosamente! Bienvenido!');
    }

    /**
     * Logout
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Has cerrado sesión exitosamente.');
    }
}
