<template>
  <div>
    <div class="container-counter">
      <div class="counter" v-text="count"></div>
    </div>
    <div class="container-client">
      <ul class="client-list">
        <li class="client-item">Vroom</li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      orders: []
    };
  },
  methods: {
    getOrders() {
      axios
        .get("/vehicles/today")
        .then(response => (this.orders = response.data));
    }
  },
  mounted: function() {
    this.getOrders();
  },
  computed: {
    count() {
      return this.orders.length;
    }
  }
};
</script>

<style>
</style>