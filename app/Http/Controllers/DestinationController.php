<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destination;

class DestinationController extends Controller
{
    public function index()
    {
        $destination = Destination::all();
        return view('destination.index', compact('destination'));
    }

    public function create()
    {
        return view('destination.create');
    }

    public function store(Request $request)
    {
        Destination::create($request->all());
        return redirect()->route('destination.index');
    }

    public function show(Destination $Destination)
    {
        return view('destination.show', compact('Destination'));
    }

    public function edit(Destination $Destination)
    {
        return view('destination.edit', compact('Destination'));
    }

    public function update(Request $request, Destination $Destination)
    {
        $Destination->update($request->all());
        return redirect()->route('destination.index');
    }

    public function destroy(Destination $Destination)
    {
        $Destination->delete();
        return redirect()->route('destination.index');
    }
}
