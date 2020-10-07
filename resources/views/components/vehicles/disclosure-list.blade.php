<h3>Disclosure List</h3>
{{-- It will only display if the count is more than 1, if is one it means that only the current vehicle is avaible --}}
@unless (!$disclosures)
  <table class="table pt-4">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Area</th>
        <th scope="col">Location</th>
        <th scope="col">Damage Type</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($disclosures as $key=>$disclosure)
        <tr>
          <th scope="row">{{ $key+1 }}</th>
          <td style="text-transform: capitalize">{{ $disclosure['area'] }}</td>
          <td style="text-transform: capitalize">{{ $disclosure['location'] }}</td>
          <td style="text-transform: capitalize">{{ $disclosure['damage'] }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@else
  <p class="text-muted">No disclosures avaible.</p>
@endunless