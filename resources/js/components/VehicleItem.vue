<template>
  <li class="d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center">
      <img class="client__logo client__logo--small" :src="vehicle.logo" alt />
      <a class="order" :href="link" v-text="vehicle.work_order"></a>
    </div>
    <div class="time">Time: {{vehicleTime}}</div>
  </li>
</template>

<script>
export default {
  props: ["vehicle"],

  data: function() {
    return {
      link: `/vehicles/${this.vehicle.id}`
    };
  },

  computed: {
    vehicleTime() {
      let date = moment(this.vehicle.created_at);
      return date.format("h:mm a");
    }
  }
};
</script>

<style scoped>
.order {
  font-size: 1.1rem;
}
.time {
  font-weight: bold;
}
</style>
