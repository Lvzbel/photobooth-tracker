@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="h2">Work Order: {{ $vehicle->work_order}}</h1>
    <disclosureform></disclosureform>
  </div>
@endsection