<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Destination;
use App\Models\Avis;
use Illuminate\Support\Facades\Log;
class DestinationFront extends Component
{
    public $destinations, $commentaire,$note,$destination_id;
    public $selectedDestination = null;
   

    

    public function mount()
    {
        $this->getDestinations();
    }

    public function getDestinations()
    {
        $this->destinations = Destination::all();
    }

    public function showDetails($id)
    {
        $this->selectedDestination = Destination::find($id);
    }

    public function closeDetails()
    {
        $this->selectedDestination = null;
    }
  

    public function store($destinationId)
    {
        try {
        $this->validate([
            'commentaire' => 'required',
            'note' => 'required',
        ]);

        Avis::create([
            'user_id' => auth()->user()->id, // Make sure the user is authenticated
            'destination_id' => $destinationId,
            'commentaire' => $this->commentaire,
            'note' => (int)$this->note,
            'date'=> now()
        ]);

        // Reset form fields
        $this->resetFields();

        // Optionally, emit an event or set a session flash message
        // session()->flash('message', 'Review submitted successfully.');
    } catch (\Exception $e) {
        // Emit an event with error data
        Log::error("Error submitting review", [
            'error' => $e->getMessage(),
            'user_id' => auth()->user()->id,
            'destination_id' => $this->destination_id,
            'commentaire' => $this->commentaire,
            'note' => (int)$this->note,
        ]);
        
        
        session()->flash('error', 'There was an error submitting your review. Please try again.');
    }
    }

    public function render()
    {
        return view('livewire.destination-front');
    }
    public function resetFields()
    {
        $this->commentaire = '';
        $this->note = '';
       
    }
}
