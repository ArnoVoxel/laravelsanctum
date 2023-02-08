<template>
  <div>
    LISTE DES PARTIES
    <div>{{ parties }}</div>
  </div>
</template>

<script>
// import api from "../../api/party/party";
import axios from "axios";

export default {
  name: "PartyIndex",
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
      console.log("getPartyIndex");

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
