<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function create()
    {
        return view('vehicles.create');
    }
}