<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Destination;
class DestinationDetailF extends Component
{
   
    public $selectedDestination;

    public $id;
   

    public function mount($id)
    {
        $this->destination_id = $id;
        $this->loadDestination();
    }

    public function loadDestination()
    {
        $this->selectedDestination = Destination::with('itineraire')->findOrFail($this->id);
    }
   
   
   
    public function render()
    {
        return view('livewire.destination-detail-f');
    }
}
