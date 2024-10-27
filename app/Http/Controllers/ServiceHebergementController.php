<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceHebergement;
use App\Models\Hebergement; 

class ServiceHebergementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $services = ServiceHebergement::with('hebergement')->get();
        $hebergements = Hebergement::all(); // Fetch all hebergements
        return view('services_hebergement.index', compact('services', 'hebergements'));
      
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $hebergements = Hebergement::all();
        return view('services_hebergement.create', compact('hebergements'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'hebergement_id' => 'required|exists:hebergements,id',  // Vérifie si l'hebergement_id existe dans la table 'hebergements'
            'service_nom' => 'required|string|max:255',              // Valide le nom du service
            'description' => 'nullable|string',                      // Description peut être null
            'disponibilite' => 'required|boolean',                   // Vérifie si disponibilite est un booléen (1 ou 0)
            'prix_service' => 'required|numeric',                    // Ajoutez ce champ si vous avez un prix pour le service
        ]);
    
        // Création du service
        ServiceHebergement::create([
            'hebergement_id' => $validated['hebergement_id'],
            'service_nom' => $validated['service_nom'],                      // Utilisation de 'service_nom'
            'description' => $validated['description'] ?? null,      // Si la description est null, on l'assigne à null
            'disponibilite' => $validated['disponibilite'],          // Ajoute la disponibilité
            'prix_service' => $validated['prix_service'] ?? 0,       // Ajoutez un champ prix si nécessaire
        ]);
    
        // Redirection après la création
        return redirect()->route('services_hebergement.index')->with('success', 'Service ajouté avec succès !');
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
        //
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
    $request->validate([
        'hebergement_id' => 'required|exists:hebergements,id',  
        'service_nom' => 'required|string|max:255',
        'description' => 'required|string',
        'disponibilite' => 'required|boolean',
        'prix_service' => 'required|numeric',
    ]);

    $ServiceHebergement = ServiceHebergement::findOrFail($id);
    $ServiceHebergement->hebergement_id = $request->input('hebergement_id');
    $ServiceHebergement->service_nom = $request->input('service_nom');
    $ServiceHebergement->description = $request->input('description');
    $ServiceHebergement->disponibilite = $request->input('disponibilite');
    $ServiceHebergement->prix_service = $request->input('prix_service');
    $ServiceHebergement->save();


    return redirect()->route('services_hebergement.index')->with('success', 'Service updated successfully!');

}

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ServiceHebergement = ServiceHebergement::findOrFail($id);

        // Supprimer l'hébergement
        $ServiceHebergement->delete();
    
        // Rediriger vers la liste des hébergements avec un message de succès
        return redirect()->route('services_hebergement.index')->with('success', 'Hébergement supprimé avec succès.');
  
    }
    public function frontIndex($hebergement_id)
    {
        // Fetch the Hebergement with its associated ServiceHebergements
        $hebergement = Hebergement::with('servicehebs')->findOrFail($hebergement_id);
    
        // Return the view for showing the hebergement and its services
        return view('frontheberg.serheber', compact('hebergement')); // Pass only the hebergement
    }
    
}
