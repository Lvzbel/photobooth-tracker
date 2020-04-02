@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Today's Vehicles</h1>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <ul class="list-group">
                @if (empty($work_orders))
                    @foreach ($work_orders as $work_order)
                        <li class="list-group-item">{{ $work_order->work_order }}</li>
                    @endforeach
                @else
                    <div class="alert alert-danger" role="alert">
                        No vehicles entries yet.
                    </div>
                @endif
              </ul>
        </div>
    </div>
</div>
@endsection
