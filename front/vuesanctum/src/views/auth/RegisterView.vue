<template>
  <div class="grid grid-rows-5 grid-flow-col gap-4 text-black place-content-center">
    <div class="row-span-1">
      <input
        class="form-input px-4 py-3 rounded-full"
        v-model="name"
        type="text"
        placeholder="name"
      />
    </div>
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
    <div class="row-span-1">
      <!-- confirmation passwords -->
      <input
        class="form-input px-4 py-3 rounded-full"
        v-model="password_confirmation"
        type="password"
        placeholder="password confirmation"
      />
    </div>
    <button @click="getRegister">Register</button>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Login",
  data() {
    return {
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
    };
  },
  created() {
    //
  },
  mounted() {
    //
  },
  methods: {
    getRegister() {
      return axios
        .post("http://127.0.0.1:8000/api/register", {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation,
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