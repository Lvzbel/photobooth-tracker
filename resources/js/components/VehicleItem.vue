<template>
    <li class="d-flex justify-content-between">
        <div v-text="vehicle.work_order"></div>
        <div v-text="vehicleDate"></div>
    </li>
</template>

<script>
export default {
    props: ["vehicle"],

    computed: {
        vehicleDate() {
            let date = moment(this.vehicle.created_at);
            return date.format("MMM Do YYYY");
        }
    }
};
</script>

<style></style>
