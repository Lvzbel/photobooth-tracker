<template>
  <div>
    <!-- User Role Modal -->
    <button
      type="button"
      class="btn btn-primary"
      data-toggle="modal"
      :data-target="'#' + uniqueModal"
    >Edit Roles</button>

    <!-- Modal -->
    <div
      class="modal fade"
      :id="uniqueModal"
      tabindex="-1"
      role="dialog"
      :aria-labelledby="uniqueModal + 'Label'"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" :id="uniqueModal + 'Label'">
              User:
              <span class="text-danger">{{ selecteduser.name }}</span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="roles__container">
              <div class="roles__role">
                <h5 class="text-primary">Admin</h5>
                <ul class="roles__list">
                  <li class="roles__item">Can add/edit/remove Clients</li>
                  <li class="roles__item">
                    Can grant the following roles: Admin,
                    Manager or Photobooth
                  </li>
                  <li class="roles__item">Can delete Users</li>
                  <li class="roles__item">Can edit all work orders</li>
                </ul>
              </div>

              <div class="roles__role">
                <h5 class="text-primary">Manager</h5>
                <ul class="roles__list">
                  <li class="roles__item">
                    Can grant the following roles: Manager
                    or Photographer
                  </li>
                  <li class="roles__item">Can edit all work orders</li>
                </ul>
              </div>

              <div class="roles__role">
                <h5 class="text-primary">Photographer</h5>
                <ul class="roles__list">
                  <li class="roles__item">Create new Vehicles</li>
                  <li class="roles__item">Edit their own Vehicles</li>
                </ul>
              </div>
            </div>

            <div class="roles__form">
              <select v-model="pickedRole" @change="onChange($event)">
                <option value="default" selected>Please select a role to grant</option>
                <option v-for="role in getGrantableRoles" :key="role">{{ role }}</option>
              </select>

              <button
                @click="postRemoveRole"
                class="btn btn-danger"
                :disabled="isDisableRemove"
              >Remove Role</button>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button @click="postGrantRole()" type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["role", "selecteduser"],
  data: function() {
    return {
      pickedRole: this.selecteduser.role || "default"
    };
  },
  computed: {
    uniqueModal() {
      return `userrolemodal-${this.selecteduser.id}`;
    },
    isDisableRemove() {
      // Will disable remove button if user has no roles to be remove
      return !this.selecteduser.role;
    },
    getGrantableRoles() {
      switch (this.role) {
        case "admin":
          return ["admin", "manager", "photographer"];
        case "manager":
          return ["manager", "photographer"];
        default:
          return [];
      }
    }
  },
  methods: {
    onChange(event) {
      this.pickedRole = event.target.value;
    },
    postGrantRole: function() {
      // If the grantable role is equal to previous role exit and close modal
      if (
        this.selecteduser.role === this.pickedRole ||
        this.pickedRole === "default"
      ) {
        $(`#${this.uniqueModal}`).modal("hide");
        return;
      }

      // If user already has a role, remove previous role before granting a new one
      if (this.selecteduser.role) {
        this.postRemoveRole();
      }
      axios({
        method: "post",
        url: "admin/grantrole",
        headers: {
          "X-CSRF-TOKEN": document.querySelector("#token").content
        },
        data: {
          user_id: this.selecteduser.id,
          role: this.pickedRole
        }
      }).then(response => {
        // Close modal
        $(`#${this.uniqueModal}`).modal("hide");
        this.$emit("refresh");
      });
    },
    postRemoveRole() {
      axios({
        method: "post",
        url: "admin/removerole",
        headers: {
          "X-CSRF-TOKEN": document.querySelector("#token").content
        },
        data: {
          user_id: this.selecteduser.id
        }
      }).then(response => {
        // Close modal
        $(`#${this.uniqueModal}`).modal("hide");
        this.$emit("refresh");
      });
    }
  }
};
</script>

<style></style>
