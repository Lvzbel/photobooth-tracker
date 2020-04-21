@extends('layouts.app');

@section('content')
    <div class="container">
      <h1 class="mb-4">Admin Panel</h1>
      {{-- Vue Component AdminPanel --}}
        <admintoppanel></admintoppanel>
      <div class="row my-4 d-flex justify-content-center">
        <div class="col">
          <h3>Roles List</h3>
          {{-- Vue Componet UserList --}}
          @can('viewany', $user)
          <userlist></userlist>
          @endcan
          
        </div>
      </div>
    </div>
@endsection