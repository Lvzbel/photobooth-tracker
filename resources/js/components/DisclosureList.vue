<template>
  <ul>
    <li v-for="item in list" :key="item" class="form-check">
      <input
        type="radio"
        :id="item"
        :name="item"
        :value="item"
        v-model="selection"
        class="form-check-input"
      />
      <label :for="item" class="form-check-label">{{ item }}</label>
    </li>
    <li v-if="other" class="form-group">
      <label for="other">Other</label>
      <input
        type="text"
        id="other"
        v-model="selection"
        placeholder="Describe Damage"
        class="form-control"
      />
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
.form-check-label {
  text-transform: capitalize;
}
.form-group {
  list-style: none;
}
</style>