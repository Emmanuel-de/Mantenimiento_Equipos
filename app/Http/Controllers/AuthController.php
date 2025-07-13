<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Mostrar el formulario de login
     */
    public function showLoginForm()
    {
        return view('login.login');
    }

    /**
     * Procesar el login
     */
    public function login(Request $request)
    {
        // Validar datos
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'El email es requerido',
            'email.email' => 'El email debe ser válido',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->only('email', 'remember'));
        }

        // Intentar autenticar
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Redireccionar según el rol del usuario
            $user = Auth::user();
            
            // Puedes personalizar la redirección aquí
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->withInput($request->only('email', 'remember'));
    }

    /**
     * Mostrar formulario de registro
     */
    public function showRegisterForm()
    {
        return view('login.login');
    }

    /**
     * Procesar el registro
     */
    public function register(Request $request)
    {
        // Validar datos
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'terms' => 'required|accepted',
        ], [
            'name.required' => 'El nombre es requerido',
            'name.max' => 'El nombre no puede tener más de 255 caracteres',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email debe ser válido',
            'email.unique' => 'Este email ya está registrado',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'terms.accepted' => 'Debes aceptar los términos y condiciones',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->only('name', 'email'))
                ->with('active_tab', 'register');
        }

        // Crear usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Asignar rol por defecto (usuario)
        $user->assignRole('usuario');

        // Autenticar automáticamente
        Auth::login($user);

        return redirect('/dashboard')->with('success', '¡Cuenta creada exitosamente!');
    }

    /**
     * Cerrar sesión
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Mostrar dashboard (página protegida)
     */
    public function dashboard()
    {
        return view('dashboard');
    }
}