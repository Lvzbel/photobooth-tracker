@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="my-4">Work Order Details</h1>

    <div class="row flex justify-content-center">
      <div class="col-md-11 col-xl-9 col">
        <div class="border border-primary rounded overflow-hidden">
          <table class="table table-striped mb-0">
            <tbody>
              <tr>
                <th scope="row">Work Order</th>
                <td>{{ $vehicle->work_order }}</td>
              </tr>
              <tr>
                <th scope="row">Photographer</th>
                <td>{{ $vehicle->user->name }}</td>
              </tr>
              <tr>
                <th scope="row">Client</th>
                <td><img class="client__logo client__logo--small" src="{{ $vehicle->client->image}}" alt=""> {{ $vehicle->client->name}}</td>
              </tr>
              <tr>
                <th scope="row">Date Taken</th>
                <td>{{ $vehicle->created_at->format('F d, Y')}}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="row flex justify-content-center mt-4">
      <div class="col-md-11 col-xl-9 col">
        <x-vehicles.delete-button :vehicle="$vehicle"></x-vehicles.delete-button>

        <x-vehicles.edit-button :vehicle="$vehicle" :small="false"></x-vehicles.edit-button>
      </div>
    </div>

    <div class="row flex justify-content-center mt-5">
      <div class="col-md-11 col-xl-9 col">
        <x-vehicles.disclosure-list :disclosures='$disclosures' :vehicle="$vehicle"></x-vehicles.reshoot-list>
      </div>
    </div>

    <div class="row flex justify-content-center mt-5">
      <div class="col-md-11 col-xl-9 col">
        <x-vehicles.reshoot-list :vehicles='$reshoots' :current="$vehicle->id"></x-vehicles.reshoot-list>
      </div>
    </div>

  </div>
@endsection