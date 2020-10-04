@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Disclosures: {{ $vehicle->work_order}}</h1>
    <disclosureform></disclosureform>
  </div>
@endsection