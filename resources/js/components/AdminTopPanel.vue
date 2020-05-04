<template>
  <div class="row my-4 d-flex justify-content-center">
    <div class="col-12 col-lg-6">
      <h3>Number of Orders Today</h3>

      <ordercounter v-if="ordersLoaded && clientsLoaded" :orders="orders" :clients="clients"></ordercounter>

      <div v-else class="spinner d-flex justify-content-center align-items-center">
        <div class="spinner-border text-primary" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
    </div>

    <div class="col-12 col-lg-6 d-flex flex-column justify-content-between">
      <h3>Current Clients</h3>

      <div v-if="clientsLoaded">
        <div class="d-flex justify-content-between">
          <a
            v-if="role === 'admin'"
            href="/clients"
            class="btn btn-primary shadow mx-auto"
          >Edit Clients</a>
          <a
            v-if="role === 'admin'"
            href="/clients/create"
            class="btn btn-primary shadow mx-auto"
          >Add New Clients</a>
        </div>
        <clientslist :clients="clients"></clientslist>
      </div>
      <div v-else class="spinner d-flex justify-content-center align-items-center">
        <div class="spinner-border text-primary" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import OrderCounter from "./OrderCounter";
import ClientList from "./ClientsList";

export default {
  props: ["role"],
  components: {
    OrderCounter,
    ClientList
  },
  data: function() {
    return {
      orders: [],
      ordersLoaded: false,
      clients: null,
      clientsLoaded: false,
      clientOrders: []
    };
  },
  methods: {
    getOrders() {
      axios.get("/vehicles/today").then(response => {
        this.orders = response.data;
        this.ordersLoaded = true;
      });
    },

    getClients() {
      axios.get("/clients/all").then(response => {
        this.clients = response.data;
        this.clientsLoaded = true;
      });
    }
  },
  mounted: function() {
    this.getClients();
    this.getOrders();
  }
};
</script>

<style scoped>
.spinner {
  height: 20rem;
  width: 100%;
}
.spinner-border {
  height: 4rem;
  width: 4rem;
}
</style>