<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Destination;
class DestinationFront extends Component
{
    public $destinations;
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

    public function render()
    {
        return view('livewire.destination-front');
    }
}
