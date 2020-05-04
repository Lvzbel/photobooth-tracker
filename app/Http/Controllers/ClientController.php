<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Intervention\Image\Facades\Image;

class ClientController extends Controller
{
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
            'name' => ['required', 'string'],
            'image' => ''
        ]);

        if(request('image')) {
            // store image in the storage/public/clients and return the path
            $imagePath = request('image')->store('clients', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(500, 500);
            
            $image->save();

            $imageArray = ['image' => "/storage/" .$imagePath];
        }

        Client::create(array_merge(
            $validatedData,
            $imageArray ?? []
        ));

        return redirect('/clients')->with('message', 'Client has been created.');;
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