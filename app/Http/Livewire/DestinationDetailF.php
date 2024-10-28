<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Destination;
use App\Models\hebergement;
use App\Models\Reservation;
use App\Models\Transport;

class DestinationDetailF extends Component
{
    public $selectedDestination;
    public $hebergements;
    public $userReservations;
    public $transports; // Define the hebergements property
    public $id;

    public function mount($id)
    {
        $this->id = $id; // Change destination_id to id
        $this->loadDestination();
        $this->loadHebergements();
        $this->loadTransports(); // Load the hebergements
    }

    public function loadDestination()
    {
        $this->selectedDestination = Destination::with('itineraire','transDestination')->findOrFail($this->id);
        $this->userReservations = Reservation::where('user_id', auth()->id())
        ->whereIn('itineraire_id', $this->selectedDestination->itineraire->pluck('id'))
        ->get();
    }

    public function loadHebergements() // Add this method to load hebergements
    {
        $this->hebergements = hebergement::all(); // Fetch all hebergements
    }

    public function loadTransports()
    {
        $this->transports = Transport::all(); // Load all transports
    }

    public function render()
    {
        $userId = auth()->id();
        $userReservedItineraireIds = Reservation::where('user_id', $userId)->pluck('itineraire_id');

        return view('livewire.destination-detail-f', [
            'userReservedItineraireIds' => $userReservedItineraireIds, // Pass reserved IDs
        ]);
    }
}
