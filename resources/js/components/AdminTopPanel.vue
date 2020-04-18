<template>
  <div class="row my-4 d-flex justify-content-center">
    <div class="col col-lg-6">
      <h3>Number of Orders Today</h3>
      <ordercounter :orders="orders"></ordercounter>
    </div>
    <div class="col col-lg-6">
      <h3>Current Clients</h3>
      <clientslist :clients="clients"></clientslist>
    </div>
  </div>
</template>

<script>
import OrderCounter from "./OrderCounter";
import ClientList from "./ClientsList";

export default {
  components: {
    OrderCounter,
    ClientList
  },
  data: function() {
    return {
      orders: [],
      clients: null
    };
  },
  methods: {
    getOrders() {
      axios
        .get("/vehicles/today")
        .then(response => (this.orders = response.data));
    },

    getClients() {
      axios
        .get("/clients/all")
        .then(response => (this.clients = response.data));
    }
  },
  mounted: function() {
    this.getClients();
    this.getOrders();
  }
};
</script>

<style>
</style>