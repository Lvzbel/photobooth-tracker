@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row d-flex justify-content-center">
    <div class="col col-md-8">
      <ul class="list-group">
        @foreach ($clients as $client)
          <li class="list-group-item">
            <div>{{$client->name}}</div>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
@endsection