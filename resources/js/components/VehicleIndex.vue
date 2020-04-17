<template>
  <div>
    <h4>List of Vehicles</h4>
    <div class="row d-flex justify-content-center my-5">
      <v-date-picker
        v-model="range"
        mode="range"
        is-inline
        :columns="$screens({ default: 1, md: 2 })"
      />
    </div>

    <div class="row d-flex justify-content-center">
      <ul class="p-0 list-group col-11 col-md-5">
        <VehicleItem
          class="list-group-item"
          v-for="vehicle in filteredVehicles"
          v-bind:key="vehicle.id"
          :vehicle="vehicle"
        ></VehicleItem>
      </ul>
    </div>
  </div>
</template>

<script>
import VCalendar from "v-calendar";
import VehicleItem from "./VehicleItem";

export default {
  components: {
    VehicleItem,
    VCalendar
  },
  data: function() {
    return {
      filteredVehicles: [],
      range: {
        start: moment()
          .subtract(4, "days")
          .toDate(),
        end: moment().toDate()
      }
    };
  },
  computed: {
    formatedStartDate() {
      return moment(this.range.start).format("YYYY-MM-DD");
    },
    formatedEndDate() {
      // In end date we compensate by adding one extra day to get the correct date
      return moment(this.range.end)
        .add(1, "days")
        .format("YYYY-MM-DD");
    }
  },
  mounted: function() {
    this.getRequest();
  },
  watch: {
    range() {
      this.onChange();
    }
  },
  methods: {
    getRequest() {
      axios
        .get(
          `/vehicles/date?end=${this.formatedEndDate}&start=${this.formatedStartDate}`
        )
        .then(response => (this.filteredVehicles = response.data));
    },
    onChange() {
      this.getRequest();
    }
  }
};
</script>

<style></style>
