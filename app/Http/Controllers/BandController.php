<?php

namespace App\Http\Controllers;

use App\Models\Band;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // withCount('albums') Para ter um album count por banda
        $bands = Band::withCount('albums')->get();

        return view('bands.index', compact('bands'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Se receber uma foto, guarda-a na variavel
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = Storage::putFile('bands', $request->file('photo'));
        }

        Band::create([
            'name' => $request->name,
            'photo' => $photoPath,
        ]);

        return redirect()->route('bands.index')->with('message', 'Band created successfully!');
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
    public function edit(Band $band)
    {
        return view('bands.edit', compact('band'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Band $band)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $photoPath = $band->photo;

        if ($request->hasFile('photo')) {
            // Se já existir uma foto, apaga-a
            if ($band->photo) {
                Storage::delete($band->photo);
            }
            $photoPath = Storage::putFile('bands', $request->file('photo'));
        }

        $band->update([
            'name' => $request->name,
            'photo' => $photoPath,
        ]);

        return redirect()->route('bands.index')->with('message', 'Band updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Band $band)
    {
        // Como não pus on-delete-cascade
        // Valida se existem albuns associados à banda
        if ($band->albums()->count() > 0) {
            return redirect()->route('bands.index')
                ->with('error', 'Cannot delete this band because it still has albums. Delete its albums first.');
        }

        if ($band->photo) {
            Storage::delete($band->photo);
        }

        $band->delete();

        return redirect()->route('bands.index')->with('message', 'Band deleted successfully!');
    }
}
