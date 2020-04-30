<template>
  <div class="group">
    <h3>Date:</h3>
    <ul class="group__list">
      <VehicleItem
        class="list-group-item"
        v-for="vehicle in vehicles"
        v-bind:key="vehicle.id"
        :vehicle="vehicle"
      ></VehicleItem>
    </ul>
  </div>
</template>

<script>
import VehicleItem from "./VehicleItem";

export default {
  props: ["vehicles", "rage"],
  components: {
    VehicleItem
  },
  mounted: function() {
    console.log(this.rage);
  },
  methods: {
    sortByDays() {}
  }
};
</script>

<style>
</style>