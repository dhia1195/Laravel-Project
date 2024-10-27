<?php

namespace App\Http\Controllers;

use App\Models\TransportItineraire;
use App\Models\Transport;
use App\Models\Destination;
use Illuminate\Http\Request;

class TransportItineraireController extends Controller
{
    /**
     * Affiche la liste des transports itinéraires.
     */
    public function index()
    {
        $transportItineraires = TransportItineraire::with('transport')->get();
        $transports =Transport ::all();
        $destinations =Destination ::all();
        return view('transport_itineraire.index', compact('transportItineraires','transports','destinations'));
    }

    /**
     * Affiche le formulaire de création.
     */
    public function create()
    {
        $transports = Transport::all();
        $destinations =Destination ::all();
        return view('transport_itineraire.create', compact('transports','destinations'));
    }

    /**
     * Enregistre un nouveau transport itinéraire.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'destination_id' => 'required|integer|exists:destination,id',
            'transport_id' => 'required|integer|exists:transports,id',
            'distance' => 'required|numeric',
            'duree' => 'required|numeric',
        ]);

        TransportItineraire::create($validated);

        return redirect()->route('transport_itineraires.index')
                         ->with('success', 'Transport itinéraire ajouté avec succès.');
    }

    /**
     * Affiche les détails d'un transport itinéraire.
     */
    public function show($id)
    {
        $transportItineraire = TransportItineraire::with('transport')->findOrFail($id);
        return view('transport_itineraire.show', compact('transportItineraire'));
    }

    /**
     * Affiche le formulaire d'édition d'un transport itinéraire.
     */
    public function edit($id)
    {
        $transportItineraire = TransportItineraire::findOrFail($id);
        $transports = Transport::all();
        return view('transport_itineraires.edit', compact('transportItineraire', 'transports'));
    }

    /**
     * Met à jour un transport itinéraire.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'destination_id' => 'required|integer|exists:destination,id',
            'transport_id' => 'required|integer|exists:transports,id',
            'distance' => 'required|numeric',
            'duree' => 'required|numeric',
        ]);

        $transportItineraire = TransportItineraire::findOrFail($id);
        $transportItineraire->update($validated);

        return redirect()->route('transport_itineraires.index')
                         ->with('success', 'Transport itinéraire mis à jour avec succès.');
    }

    /**
     * Supprime un transport itinéraire.
     */
    public function destroy($id)
    {
        $transportItineraire = TransportItineraire::findOrFail($id);
        $transportItineraire->delete();

        return redirect()->route('transport_itineraires.index')
                         ->with('success', 'Transport itinéraire supprimé avec succès.');
    }
    public function frontIndex($transport_id)
    {
    $transport = Transport::with('transportit')->findOrFail($transport_id); 
    return view('frontTransport.showFront', compact('transport')); 
    }  

}
