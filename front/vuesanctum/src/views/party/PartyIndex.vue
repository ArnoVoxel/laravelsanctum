<template>
  <div>
    <h1>
      <b>LISTE DES PARTIES</b>
    </h1>

    <table class="table-auto mt-2">
      <thead>
        <tr>
          <th>NOM</th>
          <th>DESCRIPTION</th>
          <th>DATE</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="party in parties" :key="party.id">
          <td>{{ party.label }}</td>
          <td>{{ party.description }}</td>
          <td>{{ party.date }}</td>
        </tr>
      </tbody>
    </table>
    <partyCreate />

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
      // if no token, redirect to login
      if (!localStorage.getItem("token")) {
        this.$router.push("/login");
      }
      axios
        .get("http://127.0.0.1:8000/api/parties", {
        })
        .then((res) => {
          console.log(res.data);
          this.parties = res.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
