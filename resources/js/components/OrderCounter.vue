<template>
  <div class="counter-main">
    <div class="container-counter">
      <div class="counter badge-primary">
        <span id="counter-display" v-text="count">Primary</span>
      </div>
    </div>
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
        theClient.count = 0;
        array.push(theClient);
      });

      this.clientsOrders = array;
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