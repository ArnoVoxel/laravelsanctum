<template>
  <div>
    <div class="grid place-content-right">
      <button
        class="btn rounded px-2 mb-1 hover:bg-amber-900"
        @click="open =!open"
      >New Party</button>
    </div>
    <Teleport to="body">
      <div
        v-if="open"
        class="modal card grid grid-rows-5 grid-flow-col gap-4 text-black place-content-center"
      >
        <!-- FIESTA LABEL -->
        <div class="row-span-1">
          <input
            class="form-input px-4 py-3 rounded-full"
            v-model="label"
            type="text"
            placeholder="fiesta label"
          />
          <div v-if="errors.label">{{ errors.label[0] }}</div>
        </div>

        <!-- FIESTA DESCRIPTION -->
        <div class="row-span-1">
          <input
            class="form-input px-4 py-3"
            v-model="description"
            type="text"
            placeholder="fiesta description"
          />
          <div v-if="errors.description">{{ errors.description[0] }}</div>
        </div>

        <!-- FIESTA DATE -->
        <div class="row-span-1">
          <input
            class="form-input px-4 py-3 rounded-full"
            v-model="date"
            type="date"
          />
          <div v-if="errors.date">{{ errors.date[0] }}</div>
        </div>

        <button
          class="btn rounded-full px-2 mb-1"
          @click="storeParty"
        >Save the Date !</button>
        <button
          class="btn rounded-full px-2 mb-1"
          @click="open = !open"
        >annuler</button>
      </div>
    </Teleport>
  </div>

</template>

<script>
import axios from "axios";

export default {
  name: "PartyCreate",
  data() {
    return {
      open: false,
      label: "",
      description: "",
      date: "",
      errors: {label:null, description:null, date:null},
    };
  },
  created() {
    //
  },
  mounted() {
    //
  },
  methods: {
    storeParty() {
      axios
        .post("http://127.0.0.1:8000/api/parties", {
          label: this.label,
          description: this.description,
          date: this.date,
        })
        .then((response) => {
          this.$emit("partyCreated", response.data);
          this.open = false;
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
    closeForm() {
      this.open = false;
      this.errors = {label:null, description:null, date:null};
    },
  },
};
</script>