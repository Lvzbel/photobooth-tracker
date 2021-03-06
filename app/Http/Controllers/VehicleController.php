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
        $clients = Client::all();

        return view('vehicles.index', compact('clients'));
    }
    
    public function show(Vehicle $vehicle)
    {
        $reshoots = Vehicle::reshoots($vehicle->work_order);

        $disclosures = $vehicle->disclosures;
        
        return view('vehicles.show', compact('vehicle', 'reshoots', 'disclosures'));
    }
    
    public function create()
    {
        $this->authorize('create', Vehicle::class);
        // Get list of current clients for form select input
        $clients = Client::all();
        
        return view('vehicles.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Vehicle::class);
        
        $validatedData = request()->validate([
            'work_order' => ['required', 'digits:7'],
            'client_id' => ['required', 'digits:1']
        ]);

        $userId = ['user_id' => Auth::id()];

        $jointData = array_merge($validatedData, $userId);

        $client = Client::findorfail($validatedData["client_id"]);

        // die(var_dump(strtolower($client->name)));
        // die(var_dump($validatedData));
        
        $vehicle = Vehicle::create($jointData);

        // die(var_dump($vehicle));

        if(strtolower($client->name) === "vroom") 
        {
            return redirect(route('disclosure', [$vehicle]));
        }

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

    public function disclosure(Vehicle $vehicle)
    {
        return view('vehicles.disclosure', compact('vehicle'));
    }

    public function disclosures(Request $request)
    {
        $validatedData = $request->validate([
            'id' => ['required', 'string'],
            'disclosures' => ['required', 'array']
        ]);

        $vehicle = Vehicle::findorfail($validatedData['id']);

        $vehicle['disclosures'] = $validatedData['disclosures'];

        $vehicle->save();
        
        return $vehicle;
    }
}