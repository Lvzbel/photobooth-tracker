@extends('layouts.app')

@section('content')
<div class="container">
  <vehicleindex :clients="{{ $clients }}"></vehicleindex>
</div>
@endsection