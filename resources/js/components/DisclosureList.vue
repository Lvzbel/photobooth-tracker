<template>
  <ul>
    <li v-for="item in list" :key="item">
      {{ item }} <button @click="onSelect(item)">Select</button>
    </li>
  </ul>
</template>

<script>
export default {
  props: {
    list: { type: Array, required: true },
  },
  methods: {
    onSelect(selection) {
      this.$emit("on-select", "hevo");
    },
  },
};
</script>

<style>
</style>