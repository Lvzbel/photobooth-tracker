<template>
  <div class="counter-main">
    <div class="container-counter">
      <div class="counter badge-primary">
        <span id="counter-display" v-text="count">Primary</span>
      </div>
    </div>
    <ul>
      <li v-for="counter in clientsOrders" :key="counter.name">
        <div v-text="counter.name"></div>
        <div v-text="counter.count"></div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: ["orders", "clients"],
  data: function() {
    return {
      clientsOrders: []
    };
  },
  methods: {
    clientTotals() {
      let array = [];
      this.clients.forEach(client => {
        const theClient = new Object();
        theClient.name = client.name;
        theClient.count = this.clientOrderCounter(client.id);
        array.push(theClient);
      });

      this.clientsOrders = array;
    },
    clientOrderCounter(id) {
      let orderCounter = 0;
      this.orders.forEach(order => {
        if (id === order.client_id) orderCounter += 1;
      });
      return orderCounter;
    }
  },
  mounted: function() {
    this.clientTotals();
  },
  computed: {
    count() {
      return this.orders.length;
    }
  }
};
</script>

<style scoped>
.counter-main {
  padding: 2rem;
}
.container-counter {
  display: flex;
  justify-content: center;
  align-items: center;
}
.counter {
  border-radius: 100%;
  width: 120px;
  height: 120px;
  display: flex;
  justify-content: center;
  align-items: center;
}
#counter-display {
  font-variant-numeric: tabular-nums;
  font-size: 3rem;
}
</style>