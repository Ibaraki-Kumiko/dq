import VueRouter from "vue-router";

import HomePage from "../components/HomePage";

const routes = [
    {
        path: '/',
        name: 'home',
        component: HomePage
    },

]

const router = new VueRouter({
    routes,
    mode: 'history'
});

export default router;
