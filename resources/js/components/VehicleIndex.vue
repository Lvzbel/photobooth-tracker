<template>
    <div>
        <h4>List of Vehicles</h4>
        <div class="row d-flex justify-content-center my-5">
            <v-date-picker
                v-model="range"
                mode="range"
                is-inline
                :columns="$screens({ default: 1, md: 2 })"
                :availableDates="{ start: minDate, end: maxDate }"
            />
        </div>

        <vehiclegroup
            :range="range"
            :vehicles="filteredVehicles"
        ></vehiclegroup>
    </div>
</template>

<script>
import VCalendar from "v-calendar";
import VehicleGroup from "./VehicleGroup";

export default {
    props: ["clients"],
    components: {
        VehicleGroup,
        VCalendar
    },
    data: function() {
        return {
            filteredVehicles: [],
            range: {
                start: moment()
                    .subtract(4, "days")
                    .startOf("day")
                    .toDate(),
                end: moment()
                    .startOf("day")
                    .toDate()
            }
        };
    },
    computed: {
        formatedStartDate() {
            return moment(this.range.start).format("YYYY-MM-DD");
        },
        formatedEndDate() {
            // In end date we compensate by adding one extra day to get the correct date
            return moment(this.range.end)
                .add(1, "days")
                .format("YYYY-MM-DD");
        },
        minDate() {
            return new Date(2020, 4, 1);
        },
        maxDate() {
            return new Date();
        }
    },
    mounted: function() {
        this.getRequest();
    },
    watch: {
        range() {
            this.onChange();
        }
    },
    methods: {
        getRequest() {
            axios
                .get(
                    `/vehicles/date?end=${this.formatedEndDate}&start=${this.formatedStartDate}`
                )
                .then(
                    response =>
                        (this.filteredVehicles = this.addLogo(response.data))
                );
        },
        onChange() {
            this.getRequest();
            // console.log(
            //   `/vehicles/date?end=${this.formatedEndDate}&start=${this.formatedStartDate}`
            // );
        },
        addLogo(vehicles) {
            return vehicles.map(vehicle => {
                const modifiedVehicle = vehicle;
                this.clients.find(client => {
                    if (client.id === vehicle.client_id) {
                        const imageUrl = client.image;
                        modifiedVehicle["logo"] = imageUrl;
                    }
                });
                return modifiedVehicle;
            });
        }
    }
};
</script>

<style></style>
