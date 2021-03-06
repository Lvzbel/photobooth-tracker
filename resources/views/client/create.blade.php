@extends('layouts.app')

@section('content')
    <div class="container">
      <h1>Add a new client</h1>
      <div class="row justify-content-center">
        <div class="col-9">

          <form action="/clients" method="post" enctype="multipart/form-data">
            {{-- Authentication Token --}}
            @csrf

            <div class="form-group row">
              <label for="name" class="col-md-3 col-form-label text-md-right">Client's Name</label>
    
              <div class="col-md-7">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    
                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>

          <div class="form-group row">
            <label for="image" class="col-md-3 col-form-label text-md-right">Client's Logo (optional)</label>
  
            <div class="col-md-7">
              <input type="file" class="form-control-file" id="image" name="image">
  
                @error('img')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

          <div class="row">
            <div class="col-md-8 offset-3">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>

          </form>

        </div>
      </div>
    </div>
@endsection