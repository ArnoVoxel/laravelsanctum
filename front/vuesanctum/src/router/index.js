import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        // {
        //     path: "/",
        //     name: "home",
        //     component: HomeView,
        // },
        {
            path: "/",
            name: "home",
            component: () => import("../views/auth/LoginView.vue"),
        },
        {
            path: "/login",
            name: "login",
            component: () => import("../views/auth/LoginView.vue"),
        },
        {
            path: "/register",
            name: "register",
            component: () => import("../views/auth/RegisterView.vue"),
        },
        {
            path: "/parties",
            name: "parties",
            component: () => import("../views/party/PartyIndex.vue"),
        },
        // {
        //     path: "/parties/create",
        //     name: "parties_create",
        //     component: () => import("../views/party/PartyCreate.vue"),
        // },
        {
            path: "/parties/:id",
            name: "party_show",
            component: () => import("../views/party/ShowParty.vue"),
        },
    ],
});

export default router;
