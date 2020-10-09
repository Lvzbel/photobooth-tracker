<template>
  <ul class="list">
    <li v-for="item in list" :key="item" class="form-check">
      <input
        type="radio"
        :id="item"
        :name="item"
        :value="item"
        v-model="selection"
        class="check-input"
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
      setTimeout(() => {
        this.$emit("on-select", value);
      }, 100);
    },
  },
  watch: {
    selection: function (value, oldValue) {
      this.onSelect(value);
    },
  },
};
</script>

<style scoped>
.form-check-label {
  text-transform: capitalize;
  border: 1px solid #ccc;
  padding: 0.75rem 0 0.75rem 0.5rem;
  border-radius: 3px;
  cursor: pointer;
  margin-bottom: 0.5rem;
  width: 100%;
}
.form-check-label:hover,
.check-input:checked + .form-check-label {
  background-color: rgba(52, 144, 220, 0.3);
}
.form-group {
  list-style: none;
}
.list {
  padding-left: 0;
}
.form-check {
  padding-left: 0;
}
.check-input {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  white-space: nowrap; /* added line */
  border: 0;
}
</style>