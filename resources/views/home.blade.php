@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Todays Orders</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <ul class="list-group">
                @foreach ($work_orders as $work_order)
                    <li class="list-group-item">{{ $work_order->work_order }}</li>
                @endforeach
              </ul>
        </div>
    </div>
</div>
@endsection
