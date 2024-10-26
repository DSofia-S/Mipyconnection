<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Mostrar el formulario de login
    public function showLoginForm()
    {
        return view('task.login'); // Asegúrate de que este es el nombre correcto de tu vista
    }

    // Procesar el login
    public function login(Request $request)
    {
        // Validar las credenciales
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt($request->only('email', 'password'))) {
            // Redirigir según el rol
            $user = Auth::user();
            if ($user->role == 'administrador') {
                return redirect()->route('admin.Empresas');
            } elseif ($user->role == 'Empresas') { // Corregido: 'Empresas' con E mayúscula
                return redirect()->route('empresa.Inicioempresas'); // Cambia esto a la ruta correspondiente
            } elseif ($user->role == 'comprador') { // Agregado: opción para comprador
                return redirect()->route('comprador.dashboard');
            }
        }

        // Si las credenciales son incorrectas, redirigir con error
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login'); // Redirigir al login después de cerrar sesión
    }
}
