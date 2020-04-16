<template>
  <li class="d-flex justify-content-between">
    <div v-text="vehicle.work_order"></div>
    <div v-text="vehicleDate"></div>
  </li>
</template>

<script>
export default {
  props: ["vehicle"],

  computed: {
    vehicleDate() {
      return this.vehicle.created_at;
    }
  }
};
</script>

<style>
</style>