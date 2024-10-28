<?php

namespace App\Http\Controllers;
use App\Models\Transport;
use Illuminate\Http\Request;
use App\Mail\HelloMail;
use Illuminate\Support\Facades\Mail;
use App\Models\TransportItineraire;
class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Get the search term from the request
    $searchTerm = $request->input('search');

    // Retrieve transports, applying a search filter if a search term is provided
    $transports = Transport::when($searchTerm, function($query, $searchTerm) {
        return $query->where('nom_trans', 'like', '%' . $searchTerm . '%');
    })->get();

    // Count transports by type
    $transportCounts = $transports->groupBy('type_trans')->map(function ($group) {
        return $group->count();
    });

    return view('transport.index', compact('transports', 'transportCounts'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transport.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom_trans' => 'required|string|max:255',
            'type_trans' => 'required|string',
            'prix_trans' => 'required|numeric',
            'impact_carbone' => 'required|string',
        ]);
    
        Transport::create($validatedData);
    
        return redirect()->route('transport.index')->with('success', 'Transport ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transport = Transport::findOrFail($id);  
    return view('transport.show', compact('transport'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transport = Transport::findOrFail($id);
        return view('transport.edit', compact('transport'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nom_trans' => 'required|string|max:255',
            'type_trans' => 'required|string',
            'prix_trans' => 'required|numeric|min:0.01',
            'impact_carbone' => 'required|string',
        ]);
        $transport = Transport::findOrFail($id);
        $transport->update($validatedData);
        return redirect()->route('transport.index')->with('success', 'Transport mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transport = Transport::findOrFail($id);
        $transport->delete();
        return redirect()->route('transport.index')->with('success', 'Transport supprimé avec succès');
    }
    
    public function frontendIndex()
    {
    $transports = Transport::all(); 
    return view('frontTransport.front', compact('transports')); 
    }  

    public function frontdetails($id)
{
    $transport = Transport::findOrFail($id);

    return view('frontTransport.showFront', compact('transport'));
}

}
