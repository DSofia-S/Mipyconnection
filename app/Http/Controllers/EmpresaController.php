<?php

namespace App\Http\Controllers;

use App\Models\Empresa; // Asegúrate de incluir el modelo
use App\Models\Archivo;  // Importar el modelo Archivo
use App\Models\User;     // Importar el modelo User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // Asegúrate de incluir el uso de Mail
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str; // Importar para generar contraseñas aleatorias
use App\Mail\WelcomeEmail; // Importar el correo de bienvenida
use App\Mail\RejectionEmail; // Importar el correo de rechazo
use Illuminate\Support\Facades\Log; // Agrega esta línea


class EmpresaController extends Controller
{
    public function paso1()
    {
        return view('empresa.paso1');
    }

    public function guardarPaso1(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'direccion' => 'required|string|max:255',  
            'telefono' => 'required|string|max:25',    
            'descripcion' => 'nullable|string|max:1000', 
        ]);

        // Guardar en la sesión
        Session::put('empresa.nombre', $request->nombre);
        Session::put('empresa.email', $request->email);
        Session::put('empresa.direccion', $request->direccion); 
        Session::put('empresa.telefono', $request->telefono); 
        Session::put('empresa.descripcion', $request->descripcion); 

        return redirect()->route('empresa.paso2');
    }

    public function paso2()
    {
        return view('empresa.paso2');
    }

    public function guardarPaso2(Request $request)
    {
        $request->validate([
            'nombre_propietario' => 'required|string|max:255',
            'direccion_propietario' => 'required|string|max:255',
            'telefono_propietario' => 'required|string|max:15',
        ]);
    
        // Guardar en la sesión
        Session::put('empresa.nombre_propietario', $request->nombre_propietario);
        Session::put('empresa.direccion_propietario', $request->direccion_propietario);
        Session::put('empresa.telefono_propietario', $request->telefono_propietario);
    
        return redirect()->route('empresa.paso3');
    }

    public function paso3()
    {
        return view('empresa.paso3');
    }

    public function guardarPaso3(Request $request)
    {
        // Validar el archivo PDF
        $request->validate([
            'documento' => 'required|file|mimes:pdf|max:2048',
        ]);
    
        // Verificar si se subió un archivo
        if ($request->hasFile('documento')) {
            $rutaArchivo = $request->file('documento')->store('documentos', 'public');
            Session::put('empresa.documento', $rutaArchivo);
        }
    
        try {
            // Crear una nueva empresa en la base de datos
            $empresa = Empresa::create([
                'user_id' => null, 
                'nombre' => Session::get('empresa.nombre'),
                'direccion' => Session::get('empresa.direccion'),
                'telefono' => Session::get('empresa.telefono'),
                'email' => Session::get('empresa.email'),
                'website' => Session::get('empresa.website'),
                'nombre_propietario' => Session::get('empresa.nombre_propietario'),
                'direccion_propietario' => Session::get('empresa.direccion_propietario'),
                'telefono_propietario' => Session::get('empresa.telefono_propietario'),
                'estado' => 'pendiente', // Estado por defecto pendiente
            ]); // Aquí se cierra correctamente el array y la función create()
            

            // Guardar el archivo en la base de datos
            if ($request->hasFile('documento')) {
                $archivo = new Archivo(); // Crear una nueva instancia del modelo Archivo
                $archivo->empresa_id = $empresa->id; // Relación con la empresa
                $archivo->nombre_archivo = $request->file('documento')->getClientOriginalName(); // Nombre original del archivo
                $archivo->ruta_archivo = $rutaArchivo; // Ruta donde se guardó
                $archivo->save(); // Guardar en la base de datos
            }
    
            // Limpiar la sesión
            Session::forget('empresa');
    
            // Redirigir con mensaje de éxito
            return redirect()->route('exitoorechazo')->with('success', 'Registro completado. Esperando aprobación del administrador.');
    
        } catch (\Exception $e) {
            // Capturar el error y redirigir con mensaje de error
            return redirect()->route('exitoorechazo')->withErrors(['error' => 'No se pudo guardar la empresa: ' . $e->getMessage()]);
        }
    }

    public function aprobar($id)
    {
        $empresa = Empresa::findOrFail($id);
    
        // Verificar si la empresa ya está aprobada o rechazada
        if ($empresa->estado === 'aprobada' || $empresa->estado === 'rechazada') {
            return redirect()->route('admin.Empresas')->with('error', 'Esta empresa ya ha sido aprobada o rechazada.');
        }
    
        // Cambiar el estado a 'aprobada'
        $empresa->estado = 'aprobada';
        $empresa->save();
        
        Log::info('Aprobando la empresa con ID: ' . $id);
    
        // Generar una contraseña provisional
        $contrasena = Str::random(8);
        
        // Verificar si el usuario ya existe
        if (User::where('email', $empresa->email)->exists()) {
            return redirect()->route('admin.Empresas')->with('error', 'El correo electrónico ya está en uso.');
        }
    
        try {
            // Crear un nuevo usuario para la empresa
            $usuario = User::create([
                'name' => $empresa->nombre,
                'email' => $empresa->email,
                'password' => bcrypt($contrasena),
                'role' => 'Empresas', // Asegúrate de que esto coincida con la migración
            ]);
            Log::info('Usuario creado para la empresa: ' . $usuario->email);
        } catch (\Exception $e) {
            Log::error('Error al crear el usuario: ' . $e->getMessage());
            return redirect()->route('admin.Empresas')->with('error', 'Error al crear el usuario: ' . $e->getMessage());
        }
    
        // Enviar correo de bienvenida
        try {
            $email = new WelcomeEmail($empresa, $contrasena);
            Log::info('Enviando correo a: ' . $empresa->email);
            Mail::to($empresa->email)->send($email);
            Log::info('Correo de bienvenida enviado a: ' . $empresa->email);
        } catch (\Exception $e) {
            Log::error('Error al enviar el correo: ' . $e->getMessage());
            return redirect()->route('admin.Empresas')->with('error', 'Error al enviar el correo de bienvenida: ' . $e->getMessage());
        }
    
        return redirect()->route('admin.Empresas')->with('success', 'La empresa ha sido aprobada y se ha enviado un correo de bienvenida.');
    }
    
    public function rechazar($id)
    {
        $empresa = Empresa::findOrFail($id);
    
       
        if ($empresa->estado === 'aprobada' || $empresa->estado === 'rechazada') {
            return redirect()->route('admin.Empresas')->with('error', 'Esta empresa ya ha sido aprobada o rechazada.');
        }
    
       
        $empresa->estado = 'rechazada';
        $empresa->save();
        
        Log::info('Rechazando la empresa con ID: ' . $id);
    
      
        try {
            Mail::to($empresa->email)->send(new RejectionEmail($empresa));
            Log::info('Correo de rechazo enviado a: ' . $empresa->email);
        } catch (\Exception $e) {
            Log::error('Error al enviar el correo de rechazo: ' . $e->getMessage());
            return redirect()->route('admin.Empresas')->with('error', 'Error al enviar el correo de rechazo: ' . $e->getMessage());
        }
    
        return redirect()->route('admin.Empresas')->with('error', 'La empresa ha sido rechazada y se ha enviado un correo informando sobre el rechazo.');
    }

    public function Inicioempresas()
    {
        return view('empresa.Inicioempresas'); 
    }

    
}

