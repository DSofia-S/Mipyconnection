<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa; 
class AdminController extends Controller
{

    public function Empresas()
    {
        $empresas = Empresa::with('archivos')->get(); 
        return view('admin.Empresas', compact('empresas')); 
    }

  
    public function Gestion($id)
    {
      
        $empresa = Empresa::with('archivos')->findOrFail($id);
        return view('admin.Gestion', compact('empresa')); 
    }
}
