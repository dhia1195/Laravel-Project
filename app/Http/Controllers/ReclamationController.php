<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Reclamation;
use Carbon\Carbon;

class ReclamationController extends Controller
{
    public function index()
    {
        $reclamations = Reclamation::all(); // Fetch all reclamations
        return view('reclamations.index', compact('reclamations')); // Return a view with reclamations
    }

    // Show the form for creating a new reclamation
    public function create()
    {
        return view('reclamations.create'); // Return a view for the creation form
    }

    // Store a newly created reclamation in storage
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            // Add other validation rules as needed
        ]);

        $userId = Auth::check() ? Auth::id() : 1;

        Reclamation::create([
            'user_id' => $userId,
            'titre' => $request->titre,
            'description' => $request->description,
            'created_at' => Carbon::now(),
            // Add other fields as necessary
        ]);

        return response()->json(['success' => 'Reclamation added successfully.']);
    }

    // Show a specific reclamation
    public function show(Reclamation $reclamation)
    {
        return view('reclamations.show', compact('reclamation')); // Return a view for a single reclamation
    }

    // Show the form for editing a reclamation
    public function edit(Reclamation $reclamation)
    {
        return view('reclamations.edit', compact('reclamation')); // Return a view for the edit form
    }

    // Update the specified reclamation in storage
    public function update(Request $request, Reclamation $reclamation)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            // Add other validation rules as needed
        ]);

        $reclamation->update([
            'titre' => $request->titre,
            'description' => $request->description,
            // Update other fields as necessary
        ]);

        return redirect()->route('reclamations.index')->with('success', 'Reclamation updated successfully.');
    }

    // Remove the specified reclamation from storage
    public function destroy(Reclamation $reclamation)
    {
        $reclamation->delete(); // Delete the reclamation
        return redirect()->route('reclamations.index')->with('success', 'Reclamation deleted successfully.');
    }

    public function showForClient()
{
    $reclamation = Reclamation::all();
    return view('frontend.reclamation', compact('reclamation'));
}

}
