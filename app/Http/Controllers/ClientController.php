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

    public function edit(Client $client)
    {
        return view('client.edit', compact('client'));
    }

    public function update(Client $client, Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string']
        ]);

        $client->update($validatedData);

        return redirect('/clients')->with('message', 'Client has been updated.');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect('/clients')->with('message', 'Client has been deleted it');
    }

    public function all()
    {
        return Client::all();
    }
}