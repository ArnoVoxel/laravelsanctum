<script>
import { RouterLink, RouterView } from "vue-router";

export default {
    name: "App",
    components: {
        RouterLink,
        RouterView,
    },
    methods: {
        logout() {
            localStorage.removeItem("token");
            this.$router.push({ name: "login" });
        },
    },
};
</script>

<template>
    <header>

        <div class="wrapper">
            <HelloWorld msg="You did it!" />

            <nav>
                <RouterLink to="/">Home</RouterLink>
                /
                <RouterLink to="/login">Login</RouterLink>
                /
                <div @click="logout">
                <RouterLink to="/login">Logout</RouterLink>
                </div>
            </nav>
        </div>
    </header>

    <RouterView />
</template>

<style lang="css" scoped></style>