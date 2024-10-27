<?php

namespace App\Http\Controllers;
use App\Models\Transport;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transports = Transport::all();
        return view('transport.index', compact('transports'));
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
            'prix_trans' => 'required|numeric',
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
    $transports = Transport::findOrFail($id);

    return view('frontTransport.showFront', compact('transports'));
}

}