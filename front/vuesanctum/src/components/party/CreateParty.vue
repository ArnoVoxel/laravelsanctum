<template>
  <div>
    <button @click="open =!open">New Party</button>
    <Teleport to="body">
      <div v-if="open" class="modal card grid grid-rows-5 grid-flow-col gap-4 text-black place-content-center">
        <!-- FIESTA LABEL -->
        <div class="row-span-1">
          <input
            class="form-input px-4 py-3 rounded-full"
            v-model="label"
            type="text"
            placeholder="fiesta label"
          />
        </div>

        <!-- FIESTA DESCRIPTION -->
        <div class="row-span-1">
          <input
            class="form-input px-4 py-3"
            v-model="description"
            type="text"
            placeholder="fiesta description"
          />
        </div>

        <!-- FIESTA DATE -->
        <div class="row-span-1">
          <input
            class="form-input px-4 py-3 rounded-full"
            v-model="date"
            type="date"
          />
        </div>

        <button @click="storeParty">Save the Date !</button>
        <button @click="open = !open">annuler</button>
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
      return axios
        .post("http://127.0.0.1:8000/api/parties", {
          label: this.label,
          description: this.description,
          date: this.date,
        })
        .then((response) => {})
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>