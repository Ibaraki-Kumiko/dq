import VueRouter from "vue-router";

import HomePage from "../components/HomePage";
import RegisterPage from "../views/RegisterPage";
import LoginPage from "../views/LoginPage";

const routes = [
    {
        path: '/',
        name: 'home',
        component: HomePage
    },
    {
        path: '/register',
        name: 'register',
        component: RegisterPage
    },
    {
        path: '/login',
        name: 'login',
        component: LoginPage
    },

    {
        path: '/logout',
        name: 'logout',
    },

]

const router = new VueRouter({
    routes,
    mode: 'history'
});

export default router;
