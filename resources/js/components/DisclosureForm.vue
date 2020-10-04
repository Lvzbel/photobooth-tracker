<template>
  <div>
    <h2>Please add anywhere from 4 to 6 disclosures</h2>
    <div>
      <div v-if="!selectedArea">Select an Area</div>
      <div v-if="selectedArea">Selected Area: {{ selectedArea }}</div>
      <ul v-if="!selectedArea">
        <li v-for="area in areas" :key="area">
          {{ area }} <button @click="setLocation(area)">Select</button>
        </li>
      </ul>
    </div>
    <div v-if="selectedArea">Locations</div>
    <div v-if="selectedLocation">Damage Type</div>
  </div>
</template>

<script>
import { areas, damageType, locations } from "../../data/disclosureData.js";
export default {
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
      console.log("Hevo ", location);
      this.selectedArea = location;
    },
    setArea(area) {
      this.area = area;
    },
    onSubmit() {
      console.log("submit");
    },
  },
};
</script>

<style>
</style>