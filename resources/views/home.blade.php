@extends('layouts.app')

@section('content')
<div class="container">
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
</div>
@endsection
