<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehicle;

class VehicleController extends Controller
{
    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $validatedData = request()->validate([
            'work_order' => ['required', 'digits:7']
        ]);

        Vehicle::create($validatedData);

        return redirect(route('welcome'));
    }
}