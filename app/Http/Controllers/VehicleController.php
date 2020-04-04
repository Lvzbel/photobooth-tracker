<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehicle;
use App\Client;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
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

    public function delete(Request $request)
    {
        $vehicle = Vehicle::find($request->id);

        $vehicle->delete();

        return redirect(route('home'))->with('message', 'Work order has been deleted');
    }
}