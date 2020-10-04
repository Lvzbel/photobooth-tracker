<template>
  <div>
    <h2>Please add anywhere from 4 to 6 disclosures</h2>
    <!-- Area -->
    <div>
      <div v-if="!selectedArea">Select an Area</div>
      <div v-if="selectedArea">Selected Area: {{ selectedArea }}</div>
      <DisclosureList v-if="!selectedArea" :list="areas" @on-select="setArea" />
    </div>
    <!-- Location -->
    <div v-if="selectedArea">
      <div v-if="!selectedLocation">Select Location</div>
      <div v-if="selectedLocation">
        Selected Location: {{ selectedLocation }}
      </div>
      <DisclosureList
        v-if="!selectedLocation"
        :list="locations[computedLocation]"
        @on-select="setLocation"
      />
    </div>
    <div v-if="selectedLocation">Damage Type</div>
  </div>
</template>

<script>
import { areas, damageType, locations } from "../../data/disclosureData.js";
import DisclosureList from "./DisclosureList";
export default {
  components: {
    DisclosureList,
  },
  data: () => {
    return {
      step: 1,
      singleDisclosure: [],
      disclosures: [],
      selectedArea: "",
      selectedLocation: "",
      selectedDamage: "",
      areas,
      damageType,
      locations,
    };
  },
  methods: {
    setLocation(location) {
      this.selectedLocation = location;
    },
    setArea(area) {
      this.selectedArea = area;
    },
    onSubmit() {
      console.log("submit");
    },
  },
  computed: {
    computedLocation() {
      let location;
      switch (this.selectedArea) {
        case "front":
          return "front";
        case "driver side":
          return "driver";
        case "rear":
          return "rear";
        case "passenger side":
          return "passenger";
        case "roof":
          return "roof";
        case "interior":
          return "interior";
      }
    },
  },
};
</script>

<style>
</style>