<template>

  <div class="grid grid-rows-3 grid-flow-col gap-4 text-black place-content-center">
    <div class="row-span-1">
      <input
        class="form-input px-4 py-3 rounded-full"
        v-model="email"
        type="email"
        placeholder="email"
      />
    </div>
    <div class="row-span-1">
      <input
        class="form-input px-4 py-3 rounded-full"
        v-model="password"
        type="password"
        placeholder="password"
      />
    </div>
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
      return axios
        .post("http://127.0.0.1:8000/api/login", {
          email: this.email,
          password: this.password,
        })
        .then((response) => {
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