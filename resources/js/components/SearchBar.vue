<template>
  <div>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">@</span>
      </div>
      <input
        v-model="search"
        @focus="toggleResults"
        @blur="clearResults"
        type="text"
        class="form-control"
        placeholder="Search Work Order"
        aria-label="Search work order"
      />
    </div>
    <ul v-show="results">
      <VehicleItem
        class="list-group-item"
        v-for="vehicle in results"
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
      search: "",
      results: null
    };
  },
  methods: {
    toggleResults() {
      console.log("Toggle Working");
    },
    clearResults() {
      setTimeout(() => {
        this.results = null;
        this.search = "";
      }, 300);
    }
  },
  watch: {
    search() {
      if (this.search.length >= 4 && this.search.length <= 7) {
        axios
          .get(`/vehicles/search?search=${this.search}`)
          .then(response => (this.results = response.data));
      }
    }
  }
};
</script>

<style>
</style>