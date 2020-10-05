<template>
  <ul>
    <!-- <li v-for="item in list" :key="item">
      {{ item }} <button @click="onSelect(item)">Select</button>
    </li> -->
    <li v-for="item in list" :key="item">
      <input
        type="radio"
        :id="item"
        :name="item"
        :value="item"
        v-model="selection"
      />
      <label :for="item">{{ item }}</label>
    </li>
  </ul>
</template>

<script>
export default {
  props: {
    list: { type: Array, required: true },
    other: { type: Boolean, default: false },
  },
  data: () => {
    return {
      selection: "",
      selections: [],
    };
  },
  methods: {
    onSelect(value) {
      this.$emit("on-select", value);
    },
  },
  watch: {
    selection: function (value, oldValue) {
      this.onSelect(value);
    },
  },
};
</script>

<style>
</style>