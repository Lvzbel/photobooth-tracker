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
  data: function() {
    return {
      dates: []
    };
  },
  components: {
    VehicleItem
  },
  mounted: function() {
    this.getDaysList();
  },
  methods: {
    getDaysList() {
      const daysList = [];
      const start = this.range.start;
      const end = this.range.end;
      let stopLoop = 0;
      let counter = 1;
      // Add starting date to daysList
      daysList.push(start);

      while (stopLoop < 1) {
        // Add number of days
        const day = this.addDays(start, counter);
        // Add new date to array and add to counter
        daysList.push(day);
        counter++;
        // Check if day is equal to end date and end loop
        console.log();
        if (moment(end).format() === moment(day).format()) {
          stopLoop++;
        }
      }
      this.dates = daysList;
    },
    formatTime(date) {
      return moment(date).format("YYYY-MM-DD");
    },
    addDays(date, dayNumber) {
      // Adds a number of days to the date
      return moment(date)
        .add(dayNumber, "days")
        .toDate();
    }
  },
  watch: {
    range() {
      this.getDaysList();
    }
  }
};
</script>

<style>
</style>