<?php

namespace App\Http\Livewire;

use App\Models\Avis;
use App\Models\Destination;
use Livewire\Component;
use PDF;
class AvisC extends Component
{
    public $avis;
    public $destinations; // Add destinations property
    public $chartData = [];
    public function mount()
    {
        $this->getAvis();
        $this->getDestinationsWithAverage();
        // $this->prepareChartData();
    }
    // public function prepareChartData()
    // {
    //     $destinations = Destination::withAvg('avis', 'note')->get();
    //     $labels = $destinations->pluck('nom')->toArray();
    //     $averageNotes = $destinations->pluck('avis_avg_note')->toArray();
    //     $this->chartData = [
    //         'labels' => $destinations->pluck('nom')->toArray(),
    //         'data' => $destinations->pluck('avis_avg_note')->toArray(),
    //     ];
    // }

    public function getAvis()
    {
        $this->avis = Avis::all();
    }

    public function getDestinationsWithAverage()
    {
        // Fetch destinations with the average note
        $this->destinations = Destination::withAvg('avis', 'note')->get();
    }

    public function render()
    {
        $destinations = Destination::withAvg('avis', 'note')->get();
            $labels = $destinations->pluck('nom')->toArray();
            $averageNotes = $destinations->pluck('avis_avg_note')->toArray();
        return view('livewire.avis-c', [
            'destinations' => $this->destinations,
            'labels' => $labels,
            'averageNotes' => $averageNotes,
            
        ]);
    }
    public function downloadPdf()
    {
        // Fetch destinations with average rating
        $destinations = Destination::withAvg('avis', 'note')->get();
    
        // Clean up data to avoid UTF-8 errors
        foreach ($destinations as $destination) {
            if (!mb_check_encoding($destination->nom, 'UTF-8')) {
                // Log or display the invalid data
                \Log::error('Invalid UTF-8 data found in destination name:', ['name' => $destination->nom]);
            }
            $destination->nom = mb_convert_encoding($destination->nom, 'UTF-8', 'UTF-8');
            $destination->avis_avg_note = mb_convert_encoding( $destination->avis_avg_note ,'UTF-8', 'UTF-8');
            
        }
    
        // Prepare data for the PDF
        $data = [
            'destinations' => $destinations,
        ];
    
        // Generate the PDF
        $pdf = PDF::loadView('pdf.statistiques',$data);
    
        // Download the PDF
        // return $pdf->download('statistiques.pdf');
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
            }, 'statistiques.pdf');
    }
    
    
}
