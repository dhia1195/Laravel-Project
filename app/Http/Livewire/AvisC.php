<?php

namespace App\Http\Livewire;
use App\Models\Avis;
use Livewire\Component;

class AvisC extends Component
{
    public $avis;

    public function mount()
    {
       
        $this->getAvis();
    }

    public function getAvis()
    {
        $this->avis = Avis::all();
    }
   
   
    public function render()
    {
        return view('livewire.avis-c');
    }
}
