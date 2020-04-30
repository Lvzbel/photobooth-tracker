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
    this.getDaysList();
  },
  methods: {
    getDaysList() {
      console.log("Start Date: ", this.range.start);
      console.log("Next Day: ", this.addOneDay(this.range.start));
      console.log("End Date: ", this.range.end);
    },
    formatTime(date) {
      return moment(date).format("YYYY-MM-DD");
    },
    addOneDay(date) {
      return moment(date)
        .add(1, "days")
        .toDate();
    }
  }
};
</script>

<style>
</style>