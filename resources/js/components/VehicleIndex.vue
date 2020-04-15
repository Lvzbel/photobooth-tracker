<template>
  <div>
    <h4>List of Vehicles</h4>
    <ul>
      <li v-for="vehicle in filteredVehicles" v-bind:key="vehicle.id" v-text="vehicle.work_order"></li>
    </ul>
  </div>
</template>

<script>
export default {
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