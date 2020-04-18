<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehicle;
use App\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class VehicleController extends Controller
{
    public function index()
    {
        return view('vehicles.index');
    }
    
    public function show(Vehicle $vehicle)
    {
        $reshoots = Vehicle::reshoots($vehicle->work_order);
        
        return view('vehicles.show', compact('vehicle', 'reshoots'));
    }
    
    public function create()
    {
        // Get list of current clients for form select input
        $clients = Client::all();
        
        return view('vehicles.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validatedData = request()->validate([
            'work_order' => ['required', 'digits:7'],
            'client_id' => ['required', 'digits:1']
        ]);

        $userId = ['user_id' => Auth::id()];

        $jointData = array_merge($validatedData, $userId);
        
        Vehicle::create($jointData);

        return redirect(route('home'))->with('message', 'Work order added.');
    }

    public function edit(Vehicle $vehicle)
    {
        // Get list of current clients for form select input
        $clients = Client::all();
        
        return view('vehicles.edit', compact('vehicle', 'clients'));
    }

    public function update(Vehicle $vehicle, Request $request)
    {
        $validatedData = $request->validate([
            'work_order' => ['required', 'digits:7'],
            'client_id' => ['required', 'digits:1']
        ]);

        $vehicle->update($validatedData);

        return redirect(route('home'))->with('message', 'Work order has been updated');
    }

    public function destroy(Vehicle $vehicle)
    {
        $this->authorize('update', $vehicle);
        
        $vehicle->delete();

        return redirect(route('home'))->with('message', 'Work order has been deleted');
    }

    public function date(Request $request)
    {
        $validatedData = $request->validate([
            'start' => ['required', 'date'],
            'end' => ['required', 'date']
        ]);

        return Vehicle::byDate($validatedData['start'], $validatedData['end']);
    }

    public function search(Request $request)
    {
        $validatedData = $request->validate([
            'search' => ['required', 'string']
        ]);

        return Vehicle::search($validatedData['search']);
    }

    public function today()
    {
        return Vehicle::todaysVehicles();

    }
}