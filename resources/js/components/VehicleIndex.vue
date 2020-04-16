<template>
  <div>
    <h4>List of Vehicles</h4>
    <ul class="list-group">
      <VehicleItem
        class="list-group-item"
        v-for="vehicle in filteredVehicles"
        v-bind:key="vehicle.id"
        :vehicle="vehicle"
      ></VehicleItem>
    </ul>
  </div>
</template>

<script>
import VehicleItem from "./VehicleItem";

export default {
  components: {
    VehicleItem
  },
  data: function() {
    return {
      filteredVehicles: []
    };
  },
  mounted: function() {
    axios
      .get(
        "http://photobooth-tracker.test/vehicles/date?end=2020-04-14&start=2020-04-05"
      )
      .then(response => (this.filteredVehicles = response.data));
  }
};
</script>

<style>
</style>