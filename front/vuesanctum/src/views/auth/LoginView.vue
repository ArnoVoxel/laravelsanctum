<template>
  <div class="text-black">

    <input
      style="color: black;"
      v-model="email"
      type="email"
      placeholder="email"
    />
    <input
      style="color: black;"
      v-model="password"
      type="password"
      placeholder="password"
    />
    <button @click="getLogin">Login</button>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Login",
  data() {
    return {
      email: "",
      password: "",
    };
  },
  created() {
    //
  },
  mounted() {
    //
  },
  methods: {
    getLogin() {
      console.log("getLogin");
      return axios
        .post("http://127.0.0.1:8000/api/login", {
          email: this.email,
          password: this.password,
        })
        .then((response) => {
          // Auth.login(response.access_token,response.user); //set local storage
          console.log("connexion OK", response.data);
          // this.getParties();
          localStorage.setItem("token", response.data.access_token);

          this.$router.push({ name: "parties" });
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>