<template>
    <li class="d-flex justify-content-between">
        <a :href="link" v-text="vehicle.work_order"></a>
        <div v-text="vehicleDate"></div>
    </li>
</template>

<script>
export default {
    props: ["vehicle"],

    data: function() {
        return {
            link: `/vehicles/${this.vehicle.id}`
        };
    },

    computed: {
        vehicleDate() {
            let date = moment(this.vehicle.created_at);
            return date.format("MMM Do YYYY");
        }
    }
};
</script>

<style></style>
