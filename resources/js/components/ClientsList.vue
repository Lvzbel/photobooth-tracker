<template>
  <div class="client-main">
    <ul class="client-list list-group">
      <li
        v-for="client in clients"
        class="client-item list-group-item"
        v-text="client.name"
        :key="client.id"
      ></li>
    </ul>
  </div>
</template>

<script>
export default {
  props: ["clients"]
};
</script>

<style scoped>
.client-main {
  padding: 2rem 0;
}
</style>