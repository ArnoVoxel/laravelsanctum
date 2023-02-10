import { createApp } from "vue";
import { createPinia } from "pinia";

import App from "./App.vue";
import router from "./router";

import "./assets/main.css";
// import './index.css'

import axios from "axios";

// axios.defaults.baseURL = "http://localhost:8000/api";
axios.interceptors.request.use(config => {
      const token = localStorage.getItem("token");
      config.headers["Authorization"] = `Bearer ${token}`;
      return config;
    });


const app = createApp(App);

app.use(createPinia());
app.use(router);

app.mount("#app");
