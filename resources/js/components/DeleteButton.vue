<template>
  <button class="btn btn-danger btn-sm" @click="onClick">Delete</button>
</template>

<script>
export default {
  props: ["route", "item_id"],

  mounted() {
    console.log("Delete Button Mounted");
  },

  methods: {
    onClick: function() {
      axios
        .post(`/${this.route}/${this.item_id}`)
        .then(response => (window.location = "/"));
    }
  }
};
</script>

<style>
</style>