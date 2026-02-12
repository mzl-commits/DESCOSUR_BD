<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    public function index()
    {
        // Por ahora solo vista (luego lo conectamos a BD)
        return view('admin.documentos.index');
    }

    public function create()
    {
        // Por ahora solo vista (luego cargamos sectores/proyectos/tipos/ubigeo)
        return view('admin.documentos.create');
    }

    public function store(Request $request)
    {
        // MVP: valida solo archivo + nombre (ajustamos luego a tu BD real)
        $request->validate([
            'archivo' => ['required', 'file', 'max:25600'], // 25MB
            'nombre'  => ['required', 'string', 'max:255'],
        ]);

        // Luego implementamos guardado real en storage + DB
        return redirect()->route('admin.documentos.index')->with('ok', 'Documento enviado (pendiente de guardar en BD).');
    }
}
