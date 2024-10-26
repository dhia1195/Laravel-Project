<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Itineraire; // Add this line if you are using the Itineraire model

class ItineraireController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $itineraires = Itineraire::when($search, function ($query, $search) {
            return $query->where('titre', 'like', '%' . $search . '%');
        })->get();
    
        return view('itineraires.index', compact('itineraires', 'search'));
    }
    


    public function create()
    {
        // Show form for creating a new itinerary
        return view('itineraires.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required',
            'duree' => 'required|integer',
            'prix' => 'required|numeric',
            'difficulte' => 'required|string',
            'impact_carbone' => 'required|numeric',
            'image_url' => 'nullable|image|max:2048', // Validate that the file is an image
        ]);
    
        // Handle the image upload
        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('images', 'public');
        } else {
            $imagePath = null; // or a default image path if needed
        }
    
        // Create the itinerary
        Itineraire::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'duree' => $request->duree,
            'prix' => $request->prix,
            'difficulte' => $request->difficulte,
            'impact_carbone' => $request->impact_carbone,
            'image_url' => $imagePath, // Save the image path
        ]);
    
        return redirect()->route('itineraires.index')->with('success', 'Itinerary created successfully!');
    }
    

    public function show(Itineraire $itineraire)
    {
        // Show a single itinerary
        return view('itineraires.show', compact('itineraire'));
    }

    public function edit(Itineraire $itineraire)
    {
        // Show form for editing an itinerary
        return view('itineraires.edit', compact('itineraire'));
    }

    public function update(Request $request, Itineraire $itineraire)
    {
        // Validate and update the itinerary
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required',
            'duree' => 'required|integer',
            'prix' => 'required|numeric',
            'difficulte' => 'required|string',
            'impact_carbone' => 'required|numeric',
            'image_url' => 'nullable|url',
        ]);

        $itineraire->update($request->all());
        return redirect()->route('itineraires.index')->with('success', 'Itinéraire mis à jour avec succès');
    }

    public function destroy(Itineraire $itineraire)
    {
        // Delete the itinerary
        $itineraire->delete();
        return redirect()->route('itineraires.index')->with('success', 'Itinéraire supprimé avec succès');
    }
   public function showForClient()
{
    // Fetch all itineraires with their related etapes
    $itineraires = Itineraire::with('etapes')->get(); // Ensure you have the relationship defined in the Itineraire model
    $user = auth()->user();

    // Return the view with itineraires and user data
    return view('frontend.itineraires', compact('itineraires', 'user')); 
}
}
