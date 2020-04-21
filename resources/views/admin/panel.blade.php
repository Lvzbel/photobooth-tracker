@extends('layouts.app');

@section('content')
    <div class="container">
      <h1 class="mb-4">Admin Panel</h1>
      {{-- Vue Component AdminPanel --}}
        <admintoppanel></admintoppanel>
        @can('viewany', $user)
      <div class="row my-4 d-flex justify-content-center">
        <div class="col">
          <h3>Roles List</h3>
          {{-- Vue Componet UserList --}}
          <userlist></userlist>
        </div>
      </div>
      @endcan
    </div>
@endsection