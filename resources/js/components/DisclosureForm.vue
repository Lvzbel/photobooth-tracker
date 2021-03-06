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
        class="font-weight-bold select-label underline-label d-flex justify-content-between align-items-center"
      >
        <p>
          Selected Area:
          <span class="text-primary selected-option">{{ selectedArea }}</span>
        </p>
        <button
          class="btn btn-secondary btn-sm"
          data-toggle="collapse"
          data-target="#area"
        >
          <i class="fas fa-plus"></i>
        </button>
      </div>
      <div class="collapse" :class="{ show: !selectedArea }" id="area">
        <DisclosureList
          :list="areas"
          @on-select="setArea"
          :select="selectedArea"
        />
      </div>
    </div>
    <!-- Location -->
    <div v-if="selectedArea">
      <div v-if="!selectedLocation" class="font-weight-bold select-label">
        Select Location
      </div>
      <div
        v-if="selectedLocation"
        class="font-weight-bold select-label underline-label d-flex justify-content-between align-items-center"
      >
        <p>
          Selected Location:
          <span class="text-primary selected-option">{{
            selectedLocation
          }}</span>
        </p>
        <button
          class="btn btn-secondary btn-sm"
          data-toggle="collapse"
          data-target="#location"
        >
          <i class="fas fa-plus"></i>
        </button>
      </div>

      <div class="collapse" :class="{ show: !selectedLocation }" id="location">
        <DisclosureList
          :list="locations[computedLocation]"
          @on-select="setLocation"
          :select="selectedLocation"
        />
      </div>
    </div>
    <!-- Damage Type -->
    <div v-if="selectedLocation">
      <div class="font-weight-bold select-label">Damage Type:</div>
      <DisclosureList
        :other="true"
        :list="damageType"
        @on-select="setDamage"
        :select="selectedDamage"
      />
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
  props: {
    id: { type: String, required: true },
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
      if (this.selectedDamage) {
        this.addDisclosure();
      }

      const data = {
        id: this.id,
        disclosures: JSON.parse(JSON.stringify(this.disclosures)),
      };
      axios
        .post("/vehicles/disclosure/submit", data)
        .then((response) => {
          window.location.replace("/");
        })
        .catch((error) => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors || {};
          }
        });
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
      return (
        (this.step >= 4 && this.selectedDamage) ||
        (this.step >= 5 && this.step <= 7)
      );
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