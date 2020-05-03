<template>
  <div class="VehicleGroup row">
    <div
      v-for="(day, index) in sortedVehicles"
      :key="index"
      class="VehicleGroup__group col-md-6 col-lg-4"
    >
      <div class="VehicleGroup__box rounded">
        <h3>{{formatedStartDate(day[0].created_at)}}</h3>
        <ul class="group__list p-0 shadow-small">
          <VehicleItem
            class="list-group-item"
            v-for="vehicle in day"
            v-bind:key="vehicle.id"
            :vehicle="vehicle"
          ></VehicleItem>
        </ul>
      </div>
    </div>
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
      sortedVehicles: []
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
      const sortedVehicles = [];

      // grab all vehicles for the day

      this.dates.forEach(day => {
        // Group of vehicles for the day
        const vehiclesDay = [];
        // get end of day
        const endOfDay = this.addDays(day, 1);
        // Find all vehicles between day and endOfDay

        this.vehicles.forEach(vehicle => {
          const start = moment(day).format();
          const end = moment(endOfDay).format();
          const vehicleDate = moment(vehicle.created_at).format();
          if (vehicleDate > start && vehicleDate < end) {
            vehiclesDay.push(vehicle);
          }
        });
        if (vehiclesDay.length > 0) {
          sortedVehicles.push(vehiclesDay);
        }
      });

      this.sortedVehicles = sortedVehicles;
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
    },
    formatedStartDate(date) {
      return moment(date).format("dddd, MMM Do");
    }
  },
  watch: {
    range() {
      this.getDaysList();
    },
    vehicles() {
      this.getDaysList();
      this.makeGroups();
    }
  }
};
</script>

<style>
.VehicleGroup__group {
  margin: 1rem 0;
}
.VehicleGroup__box {
  background-color: rgba(52, 144, 220, 0.2);

  padding: 1rem;
}
</style>