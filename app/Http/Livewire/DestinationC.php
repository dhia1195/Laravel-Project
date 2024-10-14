<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Models\Destination;
class DestinationC extends Component
{
    public $destinations, $nom, $description, $pays, $region, $typeTourisme;
    public $destinationId;
    public $isEditMode = false;

    public function mount()
    {
          
     $this->destinations = Destination::all();
     

    
    }

    public function render()
    {
        Log::info($this->destinations); 
        return view('livewire.destination',['destinations' => $this->destinations]);
    }

    public function store()
    {
        $this->validate([
            'nom' => 'required',
            'description' => 'required',
            'pays' => 'required',
            'region' => 'required',
            'typeTourisme' => 'required',
        ]);

        Destination::create([
            'nom' => $this->nom,
            'description' => $this->description,
            'pays' => $this->pays,
            'region' => $this->region,
            'typeTourisme' => $this->typeTourisme,
        ]);

        $this->resetFields();
        $this->destinations = Destination::all();
    }

    public function edit($id)
    {
        $destination = Destination::findOrFail($id);
        $this->destinationId = $id;
        $this->nom = $destination->nom;
        $this->description = $destination->description;
        $this->pays = $destination->pays;
        $this->region = $destination->region;
        $this->typeTourisme = $destination->typeTourisme;
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate([
            'nom' => 'required',
            'description' => 'required',
            'pays' => 'required',
            'region' => 'required',
            'typeTourisme' => 'required',
        ]);

        $destination = Destination::findOrFail($this->destinationId);
        $destination->update([
            'nom' => $this->nom,
            'description' => $this->description,
            'pays' => $this->pays,
            'region' => $this->region,
            'typeTourisme' => $this->typeTourisme,
        ]);

        $this->resetFields();
        $this->destinations = Destination::all();
    }

    public function delete($id)
    {
        Destination::findOrFail($id)->delete();
        $this->destinations = Destination::all();
    }

    public function resetFields()
    {
        $this->nom = '';
        $this->description = '';
        $this->pays = '';
        $this->region = '';
        $this->typeTourisme = '';
        $this->destinationId = null;
        $this->isEditMode = false;
    }


}
