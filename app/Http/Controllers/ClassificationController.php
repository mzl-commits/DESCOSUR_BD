<?php

namespace App\Http\Controllers;

use App\Models\Classification; // 👈 ESTA LÍNEA FALTABA

class ClassificationController extends Controller
{
    public function index()
    {
        $classifications = Classification::latest()->get();

        $view = match(auth()->user()->rol) {
            'ADMIN' => 'admin.classifications.index',
            'ENCARGADO', 'LECTOR' => 'usuario.classifications.index',
            default => abort(403),
        };

        return view($view, compact('classifications'));
    }
}
