<template>
  <div>
    <ul class="list-group">
      <li v-for="user in users" class="list-group-item" :key="user.id">
        <div>
          User Name: {{ user.name }}
          <span
            v-if="user.role"
            class="badge badge-secondary"
            v-text="user.role"
          ></span>
          <div>User Email: {{ user.email }}</div>
        </div>

        <div>
          <userrolesbutton
            v-if="calcSecLevel(loginrole, user.role)"
            :selecteduser="user"
            @refresh="getUsers"
          ></userrolesbutton>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
import UserRolesButton from "./UserRolesButton";

export default {
  props: ["loginrole"],
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
    },
    calcSecLevel(currentUser, listUser) {
      // Determines securty level based on admin or manager
      const calcLevel = role => {
        switch (role) {
          case "admin":
            return 2;
          case "manager":
            return 1;
          default:
            return 0;
        }
      };
      // Determines if the current user's level is highter than the one listed
      return calcLevel(currentUser) >= calcLevel(listUser);
    }
  },
  mounted: function() {
    this.getUsers();
  }
};
</script>

<style></style>
