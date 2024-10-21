<?php

namespace App\Http\Controllers;

use App\Models\EtapeItineraire;
use App\Models\Itineraire;
use Illuminate\Http\Request;

class EtapeItineraireController extends Controller
{
    // Show all Etapes
    public function index()
    {
        // Fetch all etapes with their related itineraires
        $etapes = EtapeItineraire::with('itineraire')->get();
        $itineraires = Itineraire::all();

        // Return the index view with etapes data
        return view('etapes.index', compact('etapes', 'itineraires'));
    }

    // Show the create form
    public function create()
    {
        // Fetch all itineraires for the dropdown
        $itineraires = Itineraire::all();

        // Return the create view
        return view('etapes.create', compact('itineraires'));
    }

    // Store a new Etape
    public function store(Request $request)
    {
        // Validate the request inputs
        $validated = $request->validate([
            'itineraire_id' => 'required|exists:itineraires,id',
            'nom_etape' => 'required|string|max:255',
            'description_etape' => 'required|string',
            'ordre_etape' => 'required|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Create the new EtapeItineraire
        EtapeItineraire::create($validated);

        // Redirect to the index page with success message
        return redirect()->route('etapes.index')->with('success', 'Étape créée avec succès !');
    }

    // Show the update form in a modal
    public function edit($id)
    {
        // Fetch the etape by ID
        $etape = EtapeItineraire::findOrFail($id);
        $itineraires = Itineraire::all(); // Fetch itineraires for the dropdown

        // Return the update form as JSON for the modal
        return response()->json([
            'etape' => $etape,
            'itineraires' => $itineraires,
        ]);
    }

    // Update an existing Etape
    public function update(Request $request, $id)
    {
        // Validate the request inputs
        $validated = $request->validate([
            'itineraire_id' => 'required|exists:itineraires,id',
            'nom_etape' => 'required|string|max:255',
            'description_etape' => 'required|string',
            'ordre_etape' => 'required|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Find the etape and update it
        $etape = EtapeItineraire::findOrFail($id);
        $etape->update($validated);

        // Redirect back with a success message
        return redirect()->route('etapes.index')->with('success', 'Étape mise à jour avec succès !');
    }

    // Delete an Etape
    public function destroy($id)
    {
        // Find the etape and delete it
        $etape = EtapeItineraire::findOrFail($id);
        $etape->delete();

        // Redirect back with a success message
        return redirect()->route('etapes.index')->with('success', 'Étape supprimée avec succès !');
    }
}