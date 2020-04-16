<template>
    <div>
        <h4>List of Vehicles</h4>
        <v-date-picker v-model="range" mode="range" is-inline />

        <ul class="list-group">
            <VehicleItem
                class="list-group-item"
                v-for="vehicle in filteredVehicles"
                v-bind:key="vehicle.id"
                :vehicle="vehicle"
            ></VehicleItem>
        </ul>
    </div>
</template>

<script>
import VCalendar from "v-calendar";
import VehicleItem from "./VehicleItem";

export default {
    components: {
        VehicleItem,
        VCalendar
    },
    data: function() {
        return {
            filteredVehicles: [],
            range: {
                start: moment()
                    .subtract(4, "days")
                    .toDate(),
                end: moment().toDate()
            }
        };
    },
    computed: {
        formatedStartDate() {
            return moment(this.range.start).format("YYYY-MM-DD");
        },
        formatedEndDate() {
            return moment(this.range.end).format("YYYY-MM-DD");
        }
    },
    mounted: function() {
        axios
            .get(
                `http://photobooth-tracker.test/vehicles/date?end=${this.formatedEndDate}&start=${this.formatedStartDate}`
            )
            .then(response => (this.filteredVehicles = response.data));
    },
    watch: {
        range() {
            this.onChange();
        }
    },
    methods: {
        onChange() {
            console.log("Calendar Activated");
        }
    }
};
</script>

<style></style>
