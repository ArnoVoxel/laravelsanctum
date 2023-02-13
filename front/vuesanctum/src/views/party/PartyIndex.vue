<template>
  <div class="grid place-content-center">
    <h1>
      <font-awesome-icon :icon="['fas', 'star']" />
      <b>Your Parties</b>
      <font-awesome-icon :icon="['fas', 'star']" />
    </h1>

        <div v-if="loading">
      <div class="flex justify-center">
        <div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-12 w-12 mb-4"></div>
      </div>
    </div>

    <div v-else>
      <table class="w-full text-center ">
        <thead>
          <tr>
            <th class="py-4 px-6">NOM</th>
            <th class="py-4 px-6">DESCRIPTION</th>
            <th class="py-4 px-6">DATE</th>
            <th class="py-4 px-6">actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="party in parties"
            :key="party.id"
          >
            <td>{{ party.label }}</td>
            <td>{{ party.description }}</td>
            <td>{{ party.date }}</td>
            <td><button class="btn rounded" @click="editParty(party.id)">éditer</button></td>
          </tr>
        </tbody>
      </table>
    </div>


    <div class="grid mt-3 place-content-right">
      <partyCreate @party-created="party_created"/>
    </div>

  </div>
</template>

<script>
// import api from "../../api/party/party";
import axios from "axios";
import partyCreate from "../../components/party/CreateParty.vue";

export default {
  name: "PartyIndex",
  components: {
    partyCreate,
  },
  data() {
    return {
      parties: [],
      loading: false,
    };
  },
  created() {
    this.getPartyIndex();
  },
  mounted() {
    //
  },
  methods: {
    getPartyIndex() {
      this.loading = true;
      // if no token, redirect to login
      if (!localStorage.getItem("token")) {
        this.$router.push("/login");
      }
      axios
        .get("http://127.0.0.1:8000/api/parties", {})
        .then((res) => {
          this.parties = res.data;
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    editParty(party_id) {
      this.$router.push({ name: "party_show", params: { id: party_id } });
    },
    party_created() {
      this.getPartyIndex();
    },
  },
};
</script>
