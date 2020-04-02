@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Todays Orders</h1>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <ul class="list-group">
                @if (empty($work_orders))
                    @foreach ($work_orders as $work_order)
                        <li class="list-group-item">{{ $work_order->work_order }}</li>
                    @endforeach
                @else
                    <h3>No orders for today</h3>
                @endif
              </ul>
        </div>
    </div>
</div>
@endsection
