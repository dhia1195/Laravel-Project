<?php

namespace App\Http\Controllers;

use App\Models\TransportItineraire;
use App\Models\Transport;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;  // Import Mail facade
use App\Mail\HelloMail;  // Import HelloMail class

class TransportItineraireController extends Controller
{
    public function index()
    {
        $transportItineraires = TransportItineraire::with('transport')->get();
        $transports = Transport::all();
        $destinations = Destination::all();
        return view('transport_itineraire.index', compact('transportItineraires', 'transports', 'destinations'));
    }

    public function create()
    {
        $transports = Transport::all();
        $destinations = Destination::all();
        return view('transport_itineraire.create', compact('transports', 'destinations'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'destination_id' => 'required|integer|exists:destination,id',
            'transport_id' => 'required|integer|exists:transports,id',
            'distance' => 'required|numeric|min:0',
            'duree' => 'required|numeric|min:0',
        ]);

        $transportItineraire = TransportItineraire::create($validatedData);

        // Send an email with the newly created itinerary
        Mail::to('yosraba90@gmail.com')->send(new HelloMail($transportItineraire));

        return redirect()->route('transport_itineraires.index')
                         ->with('success', 'Transport itinéraire ajouté avec succès.');
    }

    public function show($id)
    {
        $transportItineraire = TransportItineraire::with('transport')->findOrFail($id);
        return view('transport_itineraire.show', compact('transportItineraire'));
    }

    public function edit($id)
    {
        $transportItineraire = TransportItineraire::findOrFail($id);
        $transports = Transport::all();
        return view('transport_itineraires.edit', compact('transportItineraire', 'transports'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'destination_id' => 'required|integer|exists:destination,id',
            'transport_id' => 'required|integer|exists:transports,id',
            'distance' => 'required|numeric|min:0',
            'duree' => 'required|numeric|max:50',
        ]);

        $transportItineraire = TransportItineraire::findOrFail($id);
        $transportItineraire->update($validated);

        return redirect()->route('transport_itineraires.index')
                         ->with('success', 'Transport itinéraire mis à jour avec succès.');
    }

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
