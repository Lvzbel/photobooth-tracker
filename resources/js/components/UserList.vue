<template>
  <div>
    <ul class="list-group">
      <li v-for="user in users" class="list-group-item" :key="user.id">
        <div>
          {{user.name}}
          <span v-if="user.role" class="badge badge-secondary" v-text="user.role"></span>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      users: []
    };
  },
  methods: {
    getUsers() {
      axios.get("/admin/all").then(response => (this.users = response.data));
    }
  },
  mounted: function() {
    this.getUsers();
  }
};
</script>

<style>
</style>