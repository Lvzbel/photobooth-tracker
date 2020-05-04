<template>
  <div class="client-main">
    <ul class="client-list list-group">
      <li v-for="client in clients" class="client-item list-group-item" :key="client.id">
        <img class="client__logo client__logo--small" :src="client.image" alt />
        <span class="client-name">{{ client.name }}</span>
      </li>
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
.client-name {
  font-weight: bold;
}
</style>