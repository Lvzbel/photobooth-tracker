<template>
  <div>
    <h2 class="h3">{{ step }} of 6 disclosures</h2>
    <p class="lead">Min of 4 and a max of 6 disclosures allowed</p>
    <!-- Area -->
    <div>
      <div v-if="!selectedArea" class="font-weight-bold select-label">
        Select an Area
      </div>
      <div
        v-if="selectedArea"
        class="font-weight-bold select-label underline-label"
      >
        Selected Area:
        <span class="text-primary selected-option">{{ selectedArea }}</span>
      </div>
      <DisclosureList v-if="!selectedArea" :list="areas" @on-select="setArea" />
    </div>
    <!-- Location -->
    <div v-if="selectedArea">
      <div v-if="!selectedLocation" class="font-weight-bold select-label">
        Select Location
      </div>
      <div
        v-if="selectedLocation"
        class="font-weight-bold select-label underline-label"
      >
        Selected Location:
        <span class="text-primary selected-option">{{ selectedLocation }}</span>
      </div>
      <DisclosureList
        v-if="!selectedLocation"
        :list="locations[computedLocation]"
        @on-select="setLocation"
      />
    </div>
    <!-- Damage Type -->
    <div v-if="selectedLocation">
      <div class="font-weight-bold select-label">Damage Type:</div>
      <DisclosureList :other="true" :list="damageType" @on-select="setDamage" />
    </div>
    <div class="d-flex justify-content-between">
      <button @click="clearAll" class="btn btn-danger">Reset</button>
      <button v-if="showNext" @click="onNext" class="btn btn-primary">
        Next
      </button>
    </div>
    <div class="d-flex justify-content-center">
      <button v-if="showSubmit" @click="onSubmit" class="btn btn-success">
        Submit
      </button>
    </div>
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
    setDamage(damage) {
      this.selectedDamage = damage;
    },
    onNext() {
      this.addDisclosure();
      this.clearAll();
      this.step++;
    },
    onSubmit() {
      console.log(JSON.parse(JSON.stringify(this.disclosures)));
    },
    addDisclosure() {
      this.disclosures.push(this.computedDisclosure);
    },
    clearAll() {
      this.selectedArea = "";
      this.selectedLocation = "";
      this.selectedDamage = "";
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
    computedDisclosure() {
      return {
        area: this.selectedArea,
        location: this.selectedLocation,
        damage: this.selectedDamage,
      };
    },
    showNext() {
      return this.selectedDamage && this.step < 6;
    },
    showSubmit() {
      return this.selectedDamage && this.step >= 4 && this.step <= 6;
    },
  },
};
</script>

<style scoped>
.selected-option {
  text-transform: capitalize;
}
.select-label {
  margin-bottom: 0.5rem;
  font-size: 1.1rem;
}
.underline-label {
  border-bottom: 1px solid #ccc;
}
</style>