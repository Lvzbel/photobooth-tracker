@extends('layouts.app')

@section('content')
  <div class="containter">
    <h1>Add a new vehicle</h1>
    
    <div class="row justify-content-center">
      <div class="col">
        <form action="/vehicles" method="post">

          {{-- Authtentication Token --}}
          @csrf
  
          <div class="form-group row">
            <label for="work_order" class="col-md-3 col-form-label text-md-right">Work Order</label>
  
            <div class="col-md-7">
                <input id="work_order" type="text" class="form-control @error('work_order') is-invalid @enderror" name="work_order" value="{{ old('work_order') }}" required autocomplete="work_order" autofocus>
  
                @error('work_order')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
  
        <button class="btn btn-primary" type="submit">Submit</button>
        </form>
      </div>
    </div>
  </div>
@endsection