<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::with('estado')->get();
        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tag_detalle' => 'required|string|max:255',
            'id_estado' => 'required|exists:estados,id',
        ]);

        Tag::create($request->all());

        return redirect()->route('tags.index')
            ->with('success', 'Tag creado exitosamente.');
    }

    public function show(Tag $tag)
    {
        return view('tags.show', compact('tag'));
    }

    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'tag_detalle' => 'required|string|max:255',
            'id_estado' => 'required|exists:estados,id',
        ]);

        $tag->update($request->all());

        return redirect()->route('tags.index')
            ->with('success', 'Tag actualizado exitosamente.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('tags.index')
            ->with('success', 'Tag eliminado exitosamente.');
    }

    public function getTagsActivos()
    {
        $tags = Tag::where('id_estado', 1)
            ->select('id_tag', 'tag_detalle')
            ->orderBy('tag_detalle', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $tags
        ]);
    }
}
