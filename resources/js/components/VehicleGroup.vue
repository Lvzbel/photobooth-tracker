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
  props: ["vehicles", "range"],
  components: {
    VehicleItem
  },
  mounted: function() {
    console.log(typeof this.range.start);
  },
  methods: {
    getDaysList() {
      console.log(rangle.start);
    }
  }
};
</script>

<style>
</style>