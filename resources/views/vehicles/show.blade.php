@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="my-4">Work Order Details</h1>

    <div class="row flex justify-content-center">
      <div class="col-9">
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
                <td>{{ $vehicle->client->name}}</td>
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

  </div>
@endsection