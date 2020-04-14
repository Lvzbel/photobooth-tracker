@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Edit Work Order: {{ $vehicle->work_order}}</h1>
    
    <div class="row justify-content-center">
      <div class="col">
        <form action="/vehicles/{{ $vehicle->id }}" method="post">

          {{-- Authtentication Token --}}
          @csrf
          @method('PATCH')
  
          <div class="form-group row">
            <label for="work_order" class="col-md-3 col-form-label text-md-right">Work Order</label>
  
            <div class="col-md-7">
                <input id="work_order" type="text" class="form-control @error('work_order') is-invalid @enderror" name="work_order" value="{{ $vehicle->work_order }}" required autocomplete="work_order" autofocus>
  
                @error('work_order')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="client_id" class="col-md-3 col-form-label text-md-right">Client's Account</label>
            <div class="col-md-4">
              <select name="client_id" class="form-control" id="client_id">

                {{-- It preselects the correct client coming to DB --}}
                @foreach ($clients as $client)
                  <option 
                  value="{{ $client->id }}" 
                  {{ $client->id == $vehicle->client->id ? 'selected' : '' }}
                  >{{ $client->name }}</option>
                @endforeach

              </select>
            </div>
          </div>
  
          <div class="row">
            <div class="col-md-8 offset-3 d-flex justify-content-end">



              <div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
              </div>
            </div>
          </div>

        </form>
        <div class="row">
          <div class="col-md-8 offset-3 d-flex justify-content-start">
              {{-- Activates Delete Modal --}}
              <x-vehicles.delete-button :vehicle="$vehicle"></x-vehicles.delete-button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection