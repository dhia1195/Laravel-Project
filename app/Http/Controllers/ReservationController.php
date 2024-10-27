<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Itineraire;
use App\Models\Transport;
use App\Models\hebergement;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // Retrieve and display all reservations
    public function index()
    {
        $reservations = Reservation::with(['itineraire', 'hebergement', 'transport', 'user'])->get();
        $itineraires = Itineraire::all(); // Assuming Itineraire is your model
        $hebergements = hebergement::all(); // Assuming Hebergement is your model
        $transports = Transport::all();
        return view('reservations.index', compact('reservations', 'itineraires', 'hebergements', 'transports'));
    }

    public function create()
    {
        return view('reservations.create'); // Return a view for the creation form
    }

    // Store a new reservation
    public function store(Request $request)
    {
        $userId = Auth::check() ? Auth::id() : 1;
        $validatedData = $request->validate([
            'itineraire_id' => 'required|exists:itineraires,id',
            'hebergement_id' => 'required|exists:hebergements,id',
            'transport_id' => 'required|exists:transports,id',
        ]);

        $validatedData['user_id'] = Auth::id();
        $reservation = Reservation::create($validatedData);
        return redirect()->route('reservations.index')->with('success', 'Itinerary created successfully!');
    }

    // Show a specific reservation
    public function show($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        return response()->json($reservation);
    }

    // Update a specific reservation
    public function update(Request $request, $id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        $validatedData = $request->validate([
            'itineraire_id' => 'sometimes|exists:itineraires,id',
            'hebergement_id' => 'sometimes|exists:hebergements,id',
            'transport_id' => 'sometimes|exists:transports,id',
        ]);
        $validatedData['user_id'] = Auth::id();
        $reservation->update($validatedData);
        return redirect()->route('reservations.index')->with('success', 'Reclamation updated successfully.');
    }

    // Delete a specific reservation
    public function destroy($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Reclamation deleted successfully.');
    }

}
