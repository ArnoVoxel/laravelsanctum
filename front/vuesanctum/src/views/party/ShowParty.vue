<template>
  <div>
    <div v-if="loading">
      <div class="flex justify-center">
        <div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-12 w-12 mb-4"></div>
      </div>
    </div>
    <div
      v-else
      class="card grid grid-rows-5 grid-flow-col gap-4 text-black place-content-center"
    >
      <!-- FIESTA LABEL -->
      <div class="row-span-1">
        <input
          class="form-input px-4 py-3 rounded"
          v-model="party.label"
          type="text"
          placeholder="fiesta label"
        />
      </div>

      <!-- FIESTA DESCRIPTION -->
      <div class="row-span-1">
        <input
          class="form-input px-4 py-3"
          v-model="party.description"
          type="text"
          placeholder="fiesta description"
        />
      </div>

      <!-- FIESTA DATE -->
      <div class="row-span-1">
        <input
          class="form-input px-4 py-3 rounded"
          v-model="party.date"
          type="date"
        />
      </div>

      <!-- FIESTA MEMBERS -->
      <div>members</div>
      <div v-if="party.table_members.length != 0">{{ party.table_members }}</div>
      <div class="card grid grid-row-3 grid-cols-4 gap-4">
        <button
          v-if="!createMember"
          class="rounded-full col-span-1"
          @click="createMember = true"
        >
          <font-awesome-icon :icon="['fas', 'plus']" />
        </button>
        <input
          v-if="createMember"
          class="col-span-3 form-input px-4 py-3 rounded"
          v-model="member.name"
          type="text"
        />
        <input
          v-if="createMember"
          class="col-span-3 form-input px-4 py-3 rounded"
          v-model="member.email"
          type="text"
        />
        <button
          v-if="createMember"
          class="rounded-full col-span-1"
          @click="addMember()"
        >
          <font-awesome-icon :icon="['fas', 'save']" />
        </button>
        <!-- <div v-if="errors.member">{{ errors.member[0] }}</div> -->
      </div>

      <button
        class="btn rounded-full px-2 mb-1"
        @click="updateParty"
      >Save the Date !</button>
      <button
        class="btn rounded-full px-2 mb-1"
        @click="getBack"
      >Retour</button>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "ShowParty",
  data() {
    return {
      open: false,
      party: {},
      loading: false,
      createMember: false,
      member: { name: "", email: "" },
    };
  },
  created() {
    this.getParty();
  },
  mounted() {
    //
  },
  methods: {
    getParty() {
      this.loading = true;
      return axios
        .get("http://127.0.0.1:8000/api/parties/" + this.$route.params.id)
        .then((response) => {
          console.log(response.data);
          this.party = response.data.data;
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    updateParty() {
      axios
        .put("http://127.0.0.1:8000/api/parties/" + this.party.id, {
          label: this.party.label,
          description: this.party.description,
          date: this.party.date,
        })
        .then((response) => {});
      this.$router.push({ name: "parties" }).catch((error) => {
        console.log(error);
      });
    },
    addMember() {
      this.party.table_members.push(this.member);
      this.member = { name: "", email: "" };
      this.createMember = false;
      console.log(this.table_members);
    },
    getBack() {
      this.$router.push({ name: "parties" });
    },
  },
};
</script>