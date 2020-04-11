<h3>Re-shoots</h3>

@unless ($vehicles->isEmpty())
  <table class="table pt-4">
    <thead>
      <tr class="table-primary">
        <th scope="col">#</th>
        <th scope="col">Work Order</th>
        <th scope="col">Photographer</th>
        <th scope="col">Date</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($vehicles as $key=>$vehicle)
        <tr>
          <th scope="row">{{ $key+1 }}</th>
          <td><a href="/vehicles/{{ $vehicle->id }}">{{ $vehicle->work_order}}</a></td>
          <td>{{ $vehicle->user->name }}</td>
          <td>{{ $vehicle->created_at->format('F d, Y')}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@else
  <p class="text-muted">No past re-shoots</p>
@endunless