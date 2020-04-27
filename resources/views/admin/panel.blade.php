@extends('layouts.app');

@section('content')
    <div class="container">
      {{-- Token  --}}
      <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <h1 class="mb-4">Admin Panel: {{$role}}</h1>

      {{-- Vue Component AdminPanel --}}
        <admintoppanel></admintoppanel>
        @can('viewany', App\User::class)
      <div class="row my-4 d-flex justify-content-center">
        <div class="col">
          <h3>Roles List</h3>
          {{-- Vue Componet UserList --}}
          <userlist loginrole="{{$role}}"></userlist>
        </div>
      </div>
      @endcan
    </div>
@endsection