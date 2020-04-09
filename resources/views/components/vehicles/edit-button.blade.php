@can('update', $vehicle)
  <a class="btn btn-secondary {{ $small ? 'btn-sm' : ''}}" href="/vehicles/{{ $vehicle->id }}/edit">Edit</a>
@endcan