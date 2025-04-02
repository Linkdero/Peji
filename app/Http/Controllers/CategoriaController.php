<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::with('estado')->get();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'categoria_detalle' => 'required|string|max:255',
            'id_estado' => 'required|exists:estados,id',
        ]);

        Categoria::create($request->all());

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría creada exitosamente.');
    }

    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'categoria_detalle' => 'required|string|max:255',
            'id_estado' => 'required|exists:estados,id',
        ]);

        $categoria->update($request->all());

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría actualizada exitosamente.');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría eliminada exitosamente.');
    }

    public function getCategoriasActivas()
    {
        $categorias = Categoria::where('id_estado', 1)
            ->select('id_categoria', 'categoria_detalle')
            ->orderBy('categoria_detalle', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $categorias
        ]);
    }
}
