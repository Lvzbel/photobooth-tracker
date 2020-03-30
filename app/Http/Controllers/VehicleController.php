<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehicle;
use Illuminate\Support\Facades\Auth;

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

        $userId = ['user_id' => Auth::id()];

        $jointData = array_merge($validatedData, $userId);

        Vehicle::create($jointData);

        return redirect(route('welcome'));
    }
}