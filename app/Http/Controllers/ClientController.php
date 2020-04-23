<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index(Client $client)
    {
        $clients = $client::all();

        return view('client.index', compact('clients'));
    }
    
    public function create()
    {
        return view('client.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string']
        ]);

        Client::create($validatedData);

        return redirect(route('welcome'));
    }

    public function all()
    {
        return Client::all();
    }
}