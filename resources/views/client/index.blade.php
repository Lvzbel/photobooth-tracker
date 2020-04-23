@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row d-flex justify-content-center">
    <div class="col col-md-8">
      <ul class="list-group">
        @foreach ($clients as $client)
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>{{$client->name}}</div>
            <div>
              <a class="btn btn-secondary" href="/clients/{{$client->id}}/edit">Edit</a>
              <button class="btn btn-danger">Delete</button>
            </div>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
@endsection