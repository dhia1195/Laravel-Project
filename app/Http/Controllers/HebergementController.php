<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hebergement; 

class HebergementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $hebergements = Hebergement::all();
        return view('hebergements.index', compact('hebergements'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('hebergements.create');
        return redirect()->route('hebergements.index')->with('success', 'Hébergement ajouté avec succès.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required',
            'description' => 'required',
            'type' => 'required',
            'adresse' => 'required',
            'pays' => 'required',
            'ville' => 'required',
            'prix_nuit' => 'required|numeric',
            'impact_environnemental' => 'required',
            'image_url' => 'nullable|url',
        ]);
        Hebergement::create($validated);
        return redirect()->route('hebergements.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hebergement = Hebergement::findOrFail($id);
        return view('hebergements.edit', compact('hebergement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    // Debugging line
    \Log::info('Updating Hebergement', ['id' => $id, 'data' => $request->all()]);

    // Validation
    $request->validate([
        'nom' => 'required|string|max:255',
        'description' => 'required|string',
        'type' => 'required|string|max:255',
        'adresse' => 'required|string|max:255',
        'pays' => 'required|string|max:255',
        'ville' => 'required|string|max:255',
        'prix_nuit' => 'required|numeric',
        'impact_environnemental' => 'required|string|max:255',
        'image_url' => 'nullable|url',
    ]);
    
    // Find and update
    $hebergement = Hebergement::findOrFail($id);
    
    // Log the existing values
    \Log::info('Current values before update', $hebergement->toArray());

    $hebergement->update($request->all());
    
    // Log the new values after update
    \Log::info('New values after update', $hebergement->toArray());

    return redirect()->route('hebergements.index')->with('success', 'Hébergement mis à jour avec succès.');
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hebergement = Hebergement::findOrFail($id);

        // Supprimer l'hébergement
        $hebergement->delete();
    
        // Rediriger vers la liste des hébergements avec un message de succès
        return redirect()->route('hebergements.index')->with('success', 'Hébergement supprimé avec succès.');
    }
    public function showForHebergement()
    {
        $hebergements = Hebergement::all();
        $user=auth()->user();
        return view('frontend.itineraires', compact('hebergements', 'user')); 
    }
    public function serviceHebergements()
    {
        return $this->hasMany(ServiceHebergement::class, 'hebergement_id');
    }
}

