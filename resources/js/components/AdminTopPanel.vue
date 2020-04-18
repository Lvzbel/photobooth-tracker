<template>
  <div class="row my-4 d-flex justify-content-center">
    <div class="col col-lg-6">
      <h3>Number of Orders Today</h3>
      <ordercounter></ordercounter>
    </div>
    <div class="col col-lg-6">
      <h3>Current Clients</h3>
      <clientslist></clientslist>
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
  }
};
</script>

<style>
</style>