<template>
  <ul>
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
    <li v-if="other">
      <input
        type="text"
        id="other"
        v-model="selection"
        placeholder="Describe Damage"
      />
      <label for="other">Other</label>
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