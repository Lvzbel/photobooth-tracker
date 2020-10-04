<template>
  <div>
    <h2>Please add anywhere from 4 to 6 disclosures</h2>
    <div>
      <div v-if="!selectedArea">Select an Area</div>
      <div v-if="selectedArea">Selected Area: {{ selectedArea }}</div>
      <DisclosureList
        v-if="!selectedArea"
        :list="areas"
        @on-select="setLocation"
      />
    </div>
    <div v-if="selectedArea">Locations</div>
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
};
</script>

<style>
</style>