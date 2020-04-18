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
  props: ["orders"],

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