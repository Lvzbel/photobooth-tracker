<h3>Re-shoots</h3>
{{-- It will only display if the count is more than 1, if is one it means that only the current vehicle is avaible --}}
@unless ($vehicles->count() == 1)
  <table class="table pt-4">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Work Order</th>
        <th scope="col">Photographer</th>
        <th scope="col">Date</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($vehicles as $key=>$vehicle)
        <tr class="{{ $current == $vehicle->id ? 'table-primary' : ''}}">
          <th scope="row">{{ $key+1 }}</th>
          <td><a href="/vehicles/{{ $vehicle->id }}">{{ $vehicle->work_order}}</a></td>
          <td>{{ $vehicle->user->name }}</td>
          <td>{{ $vehicle->created_at->format('m/d/y')}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@else
  <p class="text-muted">No past re-shoots</p>
@endunless