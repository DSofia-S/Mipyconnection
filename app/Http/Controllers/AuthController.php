<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); 
    }

    // Procesar el login
    public function login(Request $request)
    {
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

      
        if (Auth::attempt($request->only('email', 'password'))) {
            // Obtener el usuario autenticado
            $user = Auth::user();

           
            switch ($user->role) {
                case 'administrador':
                    return redirect()->route('admin.Empresas');
                case 'Empresas':
                    return redirect()->route('empresa.Inicioempresas'); 
                case 'comprador':
                    return redirect()->route('comprador.dashboard'); 
                default:
                    return redirect('/')->with('error', 'Rol no reconocido.'); // Manejo de rol no reconocido
            }
        }

     
        return back()->withErrors(['email' => 'Las credenciales son incorrectas.']);
    }

    // Cerrar sesión
    public function logout()
    {
        Auth::logout();
        return redirect('/login'); 
    }
}
