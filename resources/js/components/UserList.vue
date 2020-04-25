<template>
  <div>
    <ul class="list-group">
      <li v-for="user in users" class="list-group-item" :key="user.id">
        <div>
          User Name: {{user.name}}
          <span
            v-if="user.role"
            class="badge badge-secondary"
            v-text="user.role"
          ></span>
          <div>User Email: {{user.email}}</div>
        </div>

        <div>
          <userrolesbutton :role="'admin'"></userrolesbutton>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
import UserRolesButton from "./UserRolesButton";

export default {
  components: {
    UserRolesButton
  },
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