@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Success Alert --}}
    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>  
    @endif

    {{-- Today's Vehicles --}}
    <h1>Today's Vehicles</h1>
    <div class="row justify-content-center">
        <div class="col-md-5">
              <ul class="list-group">
                @forelse ($work_orders as $work_order)
                    <li class="list-group-item">{{ $work_order->work_order }}</li>
                @empty
                    <div class="alert alert-danger" role="alert">
                        No vehicles entries yet.
                    </div>
                @endforelse
              </ul>
        </div>
    </div>

    @auth
        <div class="row justify-content-center mt-4">
            <a class="btn btn-lg btn-primary shadow" href="/vehicles/create">Add Vehicle</a>
        </div>
    @endauth
</div>
@endsection
