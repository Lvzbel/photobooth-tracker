<template>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">@</span>
    </div>
    <input
      v-model="search"
      type="text"
      class="form-control"
      placeholder="Search Work Order"
      aria-label="Search work order"
    />
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      search: ""
    };
  },
  watch: {
    search() {
      if (this.search.length >= 4 && this.search.length <= 7) {
        axios
          .get(`/vehicles/search?search=${this.search}`)
          .then(response => console.log(response.data));
      }
    }
  }
};
</script>

<style>
</style>