<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Band;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Band $band)
    {
        $albums = $band->albums()->orderBy('release_date', 'desc')->get();

        return view('albums.index', compact('band', 'albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Band $band)
    {
        return view('albums.create', compact('band'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Band $band)
    {
        //Valida
        $request->validate([
            'name' => 'required|string|max:255',
            'release_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',//tive que remover webp porque dava problemas na exportação para pdf
            'preview_url' => 'nullable|url|max:255'
        ]);

        // Se receber uma foto, guarda-a na variavel
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = Storage::putFile('albums', $request->file('image'));
        }

        // Eloquent magic: Não é preciso definir que band_id = $band->id
        $band->albums()->create([
            'name' => $request->name,
            'release_date' => $request->release_date,
            'image' => $imagePath,
            'preview_url' => $request->preview_url
        ]);

        return redirect()->route('bands.albums.index', $band->id)
            ->with('message', 'Album added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        return view('albums.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        //Valida
        $request->validate([
            'name' => 'required|string|max:255',
            'release_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'preview_url' => 'nullable|url|max:255'
        ]);

        $imagePath = $album->image;

        if ($request->hasFile('image')) {
            // Se já existir uma foto, apaga-a
            if ($album->image) {
                Storage::delete($album->image);
            }
            $imagePath = Storage::putFile('albums', $request->file('image'));
        }

        $album->update([
            'name' => $request->name,
            'release_date' => $request->release_date,
            'image' => $imagePath,
            'preview_url' => $request->preview_url
        ]);

        return redirect()->route('bands.albums.index', $album->band_id)
            ->with('message', 'Album updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        $bandId = $album->band_id;

        if ($album->image) {
            Storage::delete($album->image);
        }

        $album->delete();

        return redirect()->route('bands.albums.index', $bandId)
            ->with('message', 'Album deleted successfully!');
    }
}
