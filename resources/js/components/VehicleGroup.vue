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
      dates: [],
      groups: [],
      test: this.vehicles
    };
  },
  components: {
    VehicleItem
  },
  mounted: function() {
    this.getDaysList();
    console.log("Mounted!");
  },
  created: function() {
    this.makeGroups(this.vehicles);
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
    },
    makeGroups(testVehicles) {
      const vehicleGroups = testVehicles;

      // grab all vehicles for the day

      this.dates.forEach(day => {
        // Group of vehicles for the day
        const vehiclesDay = [];
        // get end of day
        const endOfDay = this.addDays(day, 1);
        // Find all vehicles between day and endOfDay
        console.log("MakeGroups: ", day, " ", endOfDay);
        // this.findDailyCars(day, endOfDay);

        this.vehicles.forEach(vehicle => {
          const testVehicles = [];
          const start = moment(day).format();
          const end = moment(endOfDay).format();
          const vehicleDate = moment(vehicle.created_at).format();
          if (vehicleDate > start && vehicleDate < end) {
            testVehicles.push(vehicle);
          }
          if (testVehicles.length > 0) {
            vehiclesDay.push(testVehicles);
          }
        });
        console.log(vehiclesDay);
      });
    },
    findDailyCars(starDate, endDate) {
      // console.log(startDate, endDate);
      // this.vehicles.forEach(vehicle => {
      //   const testVehicles = [];
      //   const start = moment(startDate).format();
      //   const end = moment(endDate).format();
      //   const vehicleDate = moment(vehicle.created_at).format();
      //   if (start > vehicleDate && vehicleDate < end) {
      //     testVehicles.push(vehicle);
      //     console.log("comparison working");
      //   }
      //   console.log("Calling daily");
      // });
    }
  },
  watch: {
    range() {
      this.getDaysList();
      console.log("Watch: ", this.vehicles);
    },
    vehicles() {
      this.getDaysList();
      this.makeGroups();
    }
  }
};
</script>

<style>
</style>