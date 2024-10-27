<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Models\Destination;
use Livewire\WithFileUploads;
class DestinationC extends Component
{
    public $destinations, $nom, $description, $pays, $region, $typeTourisme,$impact_env,$image_url;
    public $destinationId;
    public $isEditMode = false;
    use WithFileUploads;

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
            'impact_env' => 'required',
            'image_url' => 'required',
        ]);
        $imagePath = $this->image_url->store('images', 'public');
        Destination::create([
            'nom' => $this->nom,
            'description' => $this->description,
            'pays' => $this->pays,
            'region' => $this->region,
            'typeTourisme' => $this->typeTourisme,
            'impact_env' => $this->impact_env,
            'image_url' => $imagePath,
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
        $this->impact_env=$destination->impact_env;
        $this->image_url=$destination->image_url;
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
            'nom' => 'required',
            'description' => 'required',
            'pays' => 'required',
            'region' => 'required',
            'typeTourisme' => 'required',
            'impact_env' => 'required',
            // 'image_url' => 'required',
        ]); 

        $destination = Destination::findOrFail($this->destinationId);
        $destination->update([
            'nom' => $this->nom,
            'description' => $this->description,
            'pays' => $this->pays,
            'region' => $this->region,
            'typeTourisme' => $this->typeTourisme,
            'impact_env' => $this->impact_env,
            'image_url' => $this->image_url,
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
        $this->impact_env="";
        $this->image_url=null;
        $this->isEditMode = false;
    }


}
