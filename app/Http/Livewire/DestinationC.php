<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Models\Destination;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Exception;
class DestinationC extends Component
{
    public $destinations, $nom, $description, $pays, $region, $typeTourisme,$impact_env,$image_url;
    public $destinationId;
    public $isEditMode = false;
    public $search = '';
    use WithFileUploads;
    public $file;

    public function import()
    {
        $this->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);

        // Log the file name and path for verification
        Log::info('CSV File Uploaded:', ['path' => $this->file->getRealPath(), 'originalName' => $this->file->getClientOriginalName()]);

        // Open the uploaded CSV file
        if (($handle = fopen($this->file->getRealPath(), 'r')) !== false) {
            // Log the start of the file processing
            Log::info('Starting CSV Import');

            // Skip the header row
            fgetcsv($handle, 1000, ';');

            // Process each row of the CSV
            while (($data = fgetcsv($handle, 1000, ';')) !== false) {
                // Log each row for debugging
                Log::info('Processing row:', [
                    'nom'          => $data[0] ?? null,
                    'description'  => $data[1] ?? null,
                    'pays'         => $data[2] ?? null,
                    'region'       => $data[3] ?? null,
                    'typeTourisme' => $data[4] ?? null,
                    'impact_env'   => $data[5] ?? null,
                    'image_url'    => $data[6] ?? null,
                ]);
               

// Create a File instance
$filePath = 'c:\\Users\\pc\\Desktop\\' . $data[6];

// Now you can store or manipulate the file
$imagePath = Storage::disk('public')->putFile('images', $filePath);
                // $imagePath =  $data[6]->store('images', 'public');
                Destination::create([
                    'nom'          => $data[0],
                    'description'  => $data[1],
                    'pays'         => $data[2],
                    'region'       => $data[3],
                    'typeTourisme' => $data[4],
                    'impact_env'   => $data[5],
                    'image_url'    => $imagePath,
                ]);
            }
            fclose($handle);

            // Log the completion of file processing
            Log::info('CSV Import Complete');
        }

        $this->reset('file');
        session()->flash('message', 'Destinations imported successfully!');
    }



    public function mount()
    {
          
     $this->destinations = Destination::all();
     

    
    }

    public function render()
    {
        
       

        return view('livewire.destination',['destinations' => $this->destinations]);
    }
    public function searchD()
    {
        
        $destinations = Destination::where('nom', 'like', '%' . $this->search . '%')->get();
        $this->destinations= $destinations;
        // }
        // else{
        //     $this->destinations = Destination::all();
        // }

        // return view('livewire.destination',['destinations' => $destinations]);
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
