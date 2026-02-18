<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentoController extends Controller
{
    public function index()
    {
        $documentos = DB::table('documentos')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('usuario.documentos.index', compact('documentos'));
    }

    public function show($id)
    {
        $documento = DB::table('documentos')
            ->where('id', $id)
            ->first();

        if (!$documento) {
            abort(404);
        }

        return view('usuario.documentos.show', compact('documento'));
    }

    // ✅ Método que faltaba
    public function create()
    {
        // Devuelve la vista de subir documento
        return view('usuario.documentos.create');
    }

    // Opcional: método para guardar
    public function store(Request $request)
    {
        // Validación básica
        $request->validate([
            'nombre' => 'required|string|max:255',
            'archivo' => 'required|file',
        ]);

        // Guardar en DB (simplificado)
        $path = $request->file('archivo')->store('documentos');

        DB::table('documentos')->insert([
            'nombre' => $request->nombre,
            'archivo' => $path,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('usuario.documentos.index')->with('success', 'Documento subido correctamente.');
    }
}